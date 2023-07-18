@extends('menu')
<style>
    .container{ padding-top: 70px;}
    .char_2 {
            display: flex;
        }

        .dunot {
            width: 700px;
        }
</style>
<div class="height-100 bg-light" style="text-align: center;">
        <h5>Thống kê đơn hàng doanh số</h5>
        <div id="chart" style="height: 250px;"></div>
        <div class="char_2">
            <div class="dunot">
                <div id="Donutchart" style="height: 250px;"></div>
            </div>
            <div class="table">
                <div class="card-body">
                    <table class="table table-bordered ">
                        <h5>Thống kê sản phẩm bán chạy nhất</h5>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>TÊN SẢN PHẨM</th>
                                <th>SỐ LƯỢNG</th>
                                <th>KÍCH THƯỚC</th>
                                <th>LOẠI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-body">
                    <table class="table table-bordered ">
                        <h5>Thống kê sản phẩm tồn</h5>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>TÊN SẢN PHẨM</th>
                                <th>SỐ LƯỢNG</th>
                                <th>KÍCH THƯỚC</th>
                                <th>LOẠI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
