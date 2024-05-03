@extends('admin.layouts.index')

@section('content')
    <!-- Topbar -->
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hóa đơn</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item">Danh mục quản lý</li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách hóa đơn</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#staticBackdrop">
                            <i class="fas fa-plus"></i>
                            Thêm mới
                        </button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Ngày mua</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Địa chỉ</th>
                                <th>Phương thức thanh toán</th>
                                <th>Phương thức vận chuyển</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#detailModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
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
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn" data-toggle="modal"
                                            data-target="#editModal"
                                            id="#modalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Thêm mới phương thức thanh toán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Ảnh đại diện</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Email</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Mật khẩu</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Quyền</label>
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

        <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalTitle">Cập nhật hóa đơn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Ảnh đại diện</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Email</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Mật khẩu</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Quyền</label>
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
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalTitle">Thông tin chi tiết đơn hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Mã hóa đơn</label>
                            <input type="text" class="form-control" id="inputAddress" disabled>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Ngày mua</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Địa chỉ nhân hàng</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Trangh thái</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tổng tiền</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Phương thức thanh toán</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Phương thức vận chuyển</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Số lượng</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên người mua</label>
                            <input type="text" class="form-control" id="inputAddress" disabled
                                   placeholder="Tên phương thức thanh toán mới ...">
                        </div>
                        <div class="col-12">
                            <label for="formControlTextarea1" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="formControlTextarea1" rows="3" disabled></textarea>
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
