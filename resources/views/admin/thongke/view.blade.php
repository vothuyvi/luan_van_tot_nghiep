@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.table {
    text-align: center;
}

.char_2 {
    display: flex;
}

.dunot {
    width: 1000px;
}

.cardBox1 {
    position: relative;
    width: 100%;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 30px;
    justify-content: center;
    /* padding-left: 200px; */
}

/* .card1 div{display:flex;} */

.cardBox1 .card1 {

    position: relative;
    border-radius: 6px;
    padding: 40px;
    background: rgba(56, 195, 234, 0.91);
    box-shadow: 0 7px 25px rgba(223, 235, 236, 0);
    justify-content: space-between;
    cursor: pointer;
    text-align: center;

}

.cardBox1 .card2 {

    position: relative;
    border-radius: 6px;
    padding: 40px;
    background: rgba(13, 136, 63, 0.91);
    box-shadow: 0 7px 25px rgba(223, 235, 236, 0);
    justify-content: space-between;
    cursor: pointer;

}

.cardBox1 .card3 {

    position: relative;
    border-radius: 6px;
    padding: 40px;
    background: rgba(240, 160, 5, 0.91);
    box-shadow: 0 7px 25px rgba(223, 235, 236, 0);
    justify-content: space-between;
    cursor: pointer;


}

.cardBox1 .card4 {

    position: relative;
    border-radius: 6px;
    padding: 40px;
    background: rgba(240, 98, 53, 0.91);
    box-shadow: 0 7px 25px rgba(223, 235, 236, 0);
    justify-content: space-between;
    cursor: pointer;


}

.cardBox1 .card1 .name {
    position: relative;
    font-size: 1.5em;
    font-weight: 500;
    text-align: center;

}

.cardBox1 .card1 .number {
    font-weight: bold;
    font-size: 1.8em;
    font-family: 'Noto Serif', serif;
    text-align: center;
}

.cardBox1 .card2 .name {
    position: relative;
    font-size: 1.5em;
    font-weight: 500;
    text-align: center;

}

.cardBox1 .card2 .number {
    font-weight: bold;
    font-size: 1.8em;
    text-align: center;
    font-family: 'Noto Serif', serif;

}

.cardBox1 .card3 .name {
    position: relative;
    font-size: 1.5em;
    font-weight: 500;
    text-align: center;


}

.cardBox1 .card3 .number {
    font-weight: bold;
    font-size: 1.8em;
    text-align: center;
    font-family: 'Noto Serif', serif;

}

.cardBox1 .card4 .name {
    position: relative;
    font-size: 1.5em;
    font-weight: 500;
    text-align: center;

}

.cardBox1 .card4 .number {
    font-weight: bold;
    font-size: 1.8em;
    text-align: center;
    font-family: 'Noto Serif', serif;

}

.cardBox1 .card1 .icon i {
    font-weight: 500;
    font-size: 3em;
    color: yellow;
    text-align: center;
}
</style>

<div class="height-100 bg-light">
    <!-- <div id="chart" style="height: 250px; width: 100%;"></div> -->
    <p style="text-align: center;font-weight: 500;font-size: 1.5em;">Thống kê theo tháng {{$thang}}</p>
    <div class="cardBox1">
        <div class="card1">
            <div>
                <div class="name">TỔNG ĐƠN</div>
                <div class="number">{{$don}}</div>
            </div>
        </div>
        <div class="card2">
            <div>
                <div class="name">TỔNG TIỀN</div>
                <div class="number">{{number_format($total)}}</div>
            </div>
        </div>
        <div class="card3">
            <div>
                <div class="name">DOANH THU</div>
                <div class="number">{{$doanhThuThucTe}}</div>
            </div>
        </div>
        <div class="card4">
            <div>
                <div class="name">ĐƠN HUỶ</div>
                <div class="number">{{$donhanghuy}}</div>
            </div>
        </div>

    </div>
    <div class="char_2">

        <div class="table">

            <div class="card-body">
                <table class="table table-bordered ">
                    <h5 style="text-align: center;font-weight: 500;font-size: 1.5em;">Sản phẩm tồn</h5>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>MÃ SẢN PHẨM</th>
                            <th>TÊN SẢN PHẨM</th>
                            <th>SỐ LƯỢNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $currentPage = Request::get('page') ? Request::get('page') - 1 : 0;
                        @endphp
                        @foreach($data as $id=>$value)
                        <tr>
                            <td>{{++$id+($currentPage*7)}}</td>
                            <td>{{$value->MaSP}}</td>
                            <td>{{$value->TenSP}}</td>
                            <td>{{$value->SoLuong}}</td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$data->links()}}

            </div>
        </div>
    </div>
</div>
<script>
new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'chart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [{
            year: 'Tháng 1',
            Tổng_đơn: 2
        },
        {
            year: 'Tháng 2',
            Tổng_đơn: 10
        },
        {
            year: 'Tháng 3',
            Tổng_đơn: 5
        },
        {
            year: 'Tháng 4',
            Tổng_đơn: 5
        },
        {
            year: 'Tháng 5',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 6',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 7',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 8',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 9',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 10',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 11',
            Tổng_đơn: 20
        },
        {
            year: 'Tháng 12',
            Tổng_đơn: 20
        },

    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['Tổng_đơn'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Tổng_đơn']
});
</script>