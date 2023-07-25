@extends('layout')
<style>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

:root {
    --header-height: 3rem;
    --nav-width: 68px;
    --first-color: #4723D9;
    --first-color-light: #AFA5D9;
    --white-color: #F7F6FB;
    --body-font: 'Nunito', sans-serif;
    --normal-font-size: 1rem;
    --z-fixed: 100
}

*,
::before,
::after {
    box-sizing: border-box
}

body {
    position: relative;
    margin: var(--header-height) 0 0 0;
    padding: 0 1rem;
    font-family: var(--body-font);
    font-size: var(--normal-font-size);
    transition: .5s
}

a {
    text-decoration: none
}

.header {
    width: 100%;
    /* height: var(--header-height); */
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 1rem;
    background-color: var(--white-color);
    z-index: var(--z-fixed);
    transition: .5s
}


.header_toggle {
    color: var(--first-color);
    font-size: 1.5rem;
    cursor: pointer
}

.header_img {
    width: 35px;
    height: 35px;
    display: flex;
    justify-content: center;
    border-radius: 50%;
    overflow: hidden;
    background-color: E0E0E0;
}

.header_img img {
    width: 60px
}

.l-navbar {
    position: fixed;
    top: 0;
    left: -30%;
    width: var(--nav-width);
    height: 100vh;
    background-color: black;
    padding: .5rem 1rem 0 0;
    transition: .5s;
    z-index: var(--z-fixed)
}

.nav {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
    width: 115%;
    flex-wrap: nowrap !important;
}

.nav a {
    text-decoration: none;
}

.nav_logo,
.nav_link {
    display: grid;
    grid-template-columns: max-content max-content;
    align-items: center;
    column-gap: 1rem;
    padding: .5rem 0 .5rem 1.5rem
}

.nav_logo {
    margin-bottom: 2rem
}

.nav_logo-icon {
    font-size: 1.25rem;
    color: var(--white-color)
}

.nav_logo-name {
    color: var(--white-color);
    font-weight: 700
}

.nav_link {
    position: relative;
    color: var(--first-color-light);
    margin-bottom: 1.5rem;
    transition: .3s
}

.nav_link:hover {
    color: var(--white-color)
}

.nav_icon {
    font-size: 1.25rem
}

.nav_list a {
    text-decoration: none;
}

.show {
    left: 0
}

.body-pd {
    padding-left: calc(var(--nav-width) + 1rem)
}

.active {
    color: var(--white-color)
}

.active::before {
    content: '';
    position: absolute;
    left: 0;
    width: 2px;
    height: 32px;
    background-color: var(--white-color)
}

.height-100 {
    padding-top: 100px;
    height: 100vh
}

@media screen and (min-width: 768px) {
    body {
        margin: calc(var(--header-height) + 1rem) 0 0 0;
        padding-left: calc(var(--nav-width) + 2rem)
    }

    .header {
        height: calc(var(--header-height) + 1rem);
        padding: 0 2rem 0 calc(var(--nav-width) + 2rem);
    }

    .header_img {
        width: 40px;
        height: 40px
    }

    .header_img img {
        width: 45px
    }

    .l-navbar {
        left: 0;
        padding: 1rem 1rem 0 0
    }

    .show {
        width: calc(var(--nav-width) + 156px)
    }

    .body-pd {
        padding-left: calc(var(--nav-width) + 188px)
    }

    .header_toggle {
        display: flex;
    }

    .search {
        padding-left: 12px;
        padding-top: 1px;
    }

    .char_2 {
        display: flex;
    }

    .dunot {
        width: 700px;
    }

    .table table {
        border: #AFA5D9;
    }

    .container {
        padding-top: 70px;
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
        display: flex;
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
        display: flex;

    }

    .cardBox1 .card3 {

        position: relative;
        border-radius: 6px;
        padding: 40px;
        background: rgba(240, 160, 5, 0.91);
        box-shadow: 0 7px 25px rgba(223, 235, 236, 0);
        justify-content: space-between;
        cursor: pointer;
        display: flex;

    }

    .cardBox1 .card4 {

        position: relative;
        border-radius: 6px;
        padding: 40px;
        background: rgba(240, 98, 53, 0.91);
        box-shadow: 0 7px 25px rgba(223, 235, 236, 0);
        justify-content: space-between;
        cursor: pointer;
        display: flex;

    }

    .cardBox1 .card1 .name {
        position: relative;
        font-size: 1.5em;
        font-weight: 500;

    }

    .cardBox1 .card1 .number {
        font-weight: 500;
        font-family: 'Noto Serif', serif;
        font-size: 1.5em;
        text-align: center;
    }

    .cardBox1 .card2 .name {
        position: relative;
        font-size: 1.5em;
        font-weight: 500;

    }

    .cardBox1 .card2 .number {
        font-weight: 500;
        font-size: 1.5em;
        text-align: center;
        font-family: 'Noto Serif', serif;

    }

    .cardBox1 .card3 .name {
        position: relative;
        font-size: 1.5em;
        font-weight: 500;

    }

    .cardBox1 .card3 .number {
        font-weight: 500;
        font-size: 1.5em;
        text-align: center;
        font-family: 'Noto Serif', serif;

    }

    .cardBox1 .card4 .name {
        position: relative;
        font-size: 1.5em;
        font-weight: 500;

    }

    .cardBox1 .card4 .number {
        font-weight: 500;
        font-size: 1.5em;
        text-align: center;
        font-family: 'Noto Serif', serif;

    }

    .cardBox1 .card1 .icon i {
        font-weight: 500;
        font-size: 3em;
        color: yellow;
        text-align: center;
    }

}
</style>

<body id="body-pd">
    <header class="header" id="header">

        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <button
            style="margin-left: auto; margin-right: 0.5rem; border:none;background-color: #F7F6FB;">{{adminUser()->Ten}}</button>

        <div class="header_img"> <img src="https://pluspng.com/img-png/png-user-icon-customer-icon-1600.png">
            <a href=""></a>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="http://127.0.0.1:8000/index" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">AdMin</span> </a>
                <div class="nav_list">
                    <a href="/sanpham" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Quản lý sản phẩm</span>

                    </a>
                    <a href="/admin/qlloai/view" class="nav_link"><i class='bx bx-grid-alt nav_icon'></i> <span
                            class="nav_name">Quản lý loại sản phẩm</span></a>
                    <a href="/taikhoan" class="nav_link"><i class='bx bx-user nav_icon'></i> <span class="nav_name">Quản
                            lý tài khoản</span> </a>
                    <a href="/admin/qlbinhluan/view" class="nav_link"><i
                            class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name"> Quản lý bình
                            luận</span> </a>
                    <a href="/admin/qltintuc/view" class="nav_link"><i class='bx bx-news nav_icon'></i> <span
                            class="nav_name"> Quản lý tin tức</span> </a>
                    <a href="/khuyenmai" class="nav_link"><i class='bx bx-gift nav_icon'></i> <span class="nav_name">
                            Quản lý khuyến mãi</span> </a>
                    <a href="/admin/qldonhang/view" class="nav_link"><i class='bx bx-bookmark nav_icon'></i> <span
                            class="nav_name">Quản lý đơn hàng</span> </a>
                    <a href="/admin/qlphieunhap/view" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span
                            class="nav_name">Quản lý phiếu nhập</span> </a>
                    <a href="/admin/thongke/view" class="nav_link"><i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Thống kê</span> </a>
                </div>
            </div>
            <a href="{{route('logout')}}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span>
            </a>
        </nav>

    </div>

    <!--Container Main start-->


    <div class="height-100 bg-light">
        <p style="text-align: center;font-weight: 500;font-size: 1.5em;">Thống kê theo tháng {{$thang}}</p>
        <div class="cardBox1">
            <div class="card1">
                <div>
                    <div class="name">TỔNG ĐƠN HÀNG</div>
                    <div class="number">{{$don}}</div>
                </div>
                <!-- <div class="icon">
                <i class='bx bx-cart nav_icon'></i>
                </div> -->
            </div>
            <div class="card2">
                <div>
                    <div class="name">TỔNG DOANH THU</div>
                    <div class="number">{{number_format($total)}}</div>
                </div>
            </div>
            <div class="card3">
                <div>
                    <div class="name"></div>
                    <div class="number"></div>
                </div>
            </div>
            <div class="card4">
                <div>
                    <div class="name"></div>
                    <div class="number"></div>
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

                            @foreach($data as $id=>$value)
                            <tr>
                                <td>{{++$id}}</td>
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




    <!-- Modal -->


    <!--modal -->
    <script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
    </script>

    <!--Container Main end-->
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });
    </script>

    </html>