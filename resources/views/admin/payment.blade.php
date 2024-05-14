@extends('admin.layouts.index')

@section('content')
    <!-- Topbar -->
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Phương thức thanh toán</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item">Danh mục quản lý</li>
                <li class="breadcrumb-item active" aria-current="page">Phương thức thanh toán</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Phương thức thanh toán</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter"
                                id="#modalCenter"><i class="fas fa-plus"></i> Thêm mới
                        </button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên phương thức</th>
                                <th>Ghi chú</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="paymentTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Thêm mới phương thức thanh toán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm" onsubmit="return false;">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Tên phương thức</label>
                                <input type="text" class="form-control" id="payment_method" name="payment_method"
                                       placeholder="Tên phương thức thanh toán mới ...">
                            </div>
                            <div class="col-12">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" rows="3" name="note"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary" onclick="addPayment()">Thêm mới</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
             aria-labelledby="editModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalTitle">Cập nhật phương thức thanh toán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="payment_method_edit" class="form-label">Tên phương thức</label>
                                <input type="text" class="form-control" id="payment_method_edit" name="payment_method_edit"
                                       placeholder="Cập nhật tên phương thức thanh toán mới ...">
                            </div>
                            <div class="col-12">
                                <label for="note_edit" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note_edit" rows="3" name="note"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary" onclick="updatePayment()">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showPayment() {
                fetch('http://127.0.0.1:8000/api/payment')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.data.data);
                        let paymentTableBody = document.getElementById('paymentTableBody');
                        paymentTableBody.innerHTML = ''; // Xóa dữ liệu cũ trong bảng

                        data.data.data.forEach(payment => {
                            paymentTableBody.innerHTML += `
                        <tr>
                            <td style="">${payment.payment_method_id}</td>
                            <td>${payment.payment_method}</td>
                            <td>${payment.note ? payment.note : '-'}</td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-success btn" data-toggle="modal"
                                        data-target="#editModal"
                                        id="#modalCenter"  onclick="showEditModal(${payment.payment_method_id})">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn"
                                        onclick="deletePayment(${payment.payment_method_id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                        });
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                    });
            }

            function addPayment() {
                let formData = new FormData(document.getElementById("addForm"));

                fetch('http://127.0.0.1:8000/api/payment', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Xử lý sau khi thêm mới thành công, reload trang
                            window.location.href = "{{ route('admin.payment') }}";
                        } else {
                            // Xử lý khi có lỗi
                            console.error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                    });
            }

            function showEditModal(payment_method_id) {
                fetch(`http://127.0.0.1:8000/api/payment/${payment_method_id}`)
                    .then(response => response.json())
                    .then(data => {
                        let payment = data.data; // Dữ liệu của phương thức thanh toán cần cập nhật
                        // Điền dữ liệu vào form cập nhật
                        document.getElementById("payment_method_edit").value = payment.payment_method;
                        document.getElementById("note_edit").value = payment.note;
                        // Mở modal cập nhật
                        $('#editModal').modal('show');
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                    });
            }

            function updatePayment() {
                let formData = new FormData(document.getElementById("editForm"));
                let payment_method_id = document.getElementById("payment_method").value; // Thay đổi tên id thành "payment_method"

                fetch(`http://127.0.0.1:8000/api/payment/${payment_method_id}`, {
                    method: 'PUT',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Xử lý sau khi cập nhật thành công, reload trang
                            window.location.reload();
                        } else {
                            // Xử lý khi có lỗi
                            console.error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                    });
            }

            function deletePayment(payment_method_id) {
                if (confirm("Bạn có chắc muốn xóa phương thức thanh toán này không?")) {
                    fetch(`http://127.0.0.1:8000/api/payment/${payment_method_id}`, {
                        method: 'DELETE'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Xử lý sau khi xóa thành công, reload trang
                                window.location.reload();
                            } else {
                                // Xử lý khi có lỗi
                                console.error(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('There was an error!', error);
                        });
                }
            }

            showPayment(); // Gọi hàm showPayment khi trang được load
        </script>
@endsection
