@extends('admin.layouts.index')

@section('content')
    <!-- Topbar -->
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Mã giảm giá</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item">Danh mục sản phẩm</li>
                <li class="breadcrumb-item active" aria-current="page">Danh mục mã giảm giá</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh mục mã giảm giá</h6>
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
                                <th>Tên mã giảm giá</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Ghi chú</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
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
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
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
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
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
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
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
                                <td>Airi Satou</td>
                                <td>Accountant</td>
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
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
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
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
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
                                <td>Serge Baldwin</td>
                                <td>Data Coordinator</td>
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
                                <td>Zenaida Frank</td>
                                <td>Software Engineer</td>
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
                                <td>Zorita Serrano</td>
                                <td>Software Engineer</td>
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
                                <td>Jennifer Acosta</td>
                                <td>Junior Javascript Developer</td>
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
                                <td>Cara Stevens</td>
                                <td>Sales Assistant</td>
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
                                <td>Hermione Butler</td>
                                <td>Regional Director</td>
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
                                <td>Lael Greer</td>
                                <td>Systems Administrator</td>
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
                                <td>Jonas Alexander</td>
                                <td>Developer</td>
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

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Thêm mới mã giảm giá</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên mã giảm giá</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Tên mã giảm giá mới ...">
                        </div>
                        <div class="col-12 form-group">
                            <label for="touchSpin1">Số lượng</label>
                            <input id="touchSpin1" type="text" class="form-control">
                        </div>
                        <div class="col-12 form-group" id="simple-date4">
                            <label for="dateRangePicker">Từ ngày - Đến ngày</label>
                            <div class="input-daterange input-group">
                                <input type="text" class="input-sm form-control" name="start"/>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">đến</span>
                                </div>
                                <input type="text" class="input-sm form-control" name="end"/>
                            </div>
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
                        <h5 class="modal-title" id="editModalTitle">Cập nhật mã giảm giá</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Tên mã giảm giá</label>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Cập nhật tên mã giảm giá mới ...">
                        </div>
                        <div class="col-12 form-group">
                            <label for="touchSpin3">Số lượng</label>
                            <input id="touchSpin3" type="text" class="form-control">
                        </div>
                        <div class="col-12 form-group" id="simple-date1">
                            <label for="simpleDataInput">Ngày bắt đầu</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput">
                            </div>
                        </div>
                        <div class="col-12 form-group" id="simple-date1">
                            <label for="simpleDataInput">Ngày kết thúc</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput">
                            </div>
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
