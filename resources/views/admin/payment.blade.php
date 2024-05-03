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
                            <tr style="text-align: center">
                                <th>STT</th>
                                <th>Tên phương thức</th>
                                <th>Ghi chú</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse( $payments as $payment )
                                    <tr>
                                        <td>{{$payment->id}}</td>
                                        <td>{{$payment->name}}</td>
                                        <td>{{$payment->note}}<</td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-success btn" data-toggle="modal"
                                                    data-target="#editModal"
                                                    id="#modalCenter">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button type="submit" class="btn btn-danger btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <th>Không có dữ liệu</th>
                                @endforelse
                            </form>
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
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên phương thức</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="formControlTextarea1" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="formControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
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
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên phương thức</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Cập nhật tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="formControlTextarea1" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="formControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
