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

}
</style>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i>

        </div>
        <!-- <div class="search"> Tìm kiếm
                <input type="text"><i class='bx bx-search-alt nav_icon'></i>
            </div> -->
        <div style="margin-left: auto; margin-right: 0.5rem">{{adminUser()->email}}</div>
        <div class="header_img"> <img src="https://pluspng.com/img-png/png-user-icon-customer-icon-1600.png">
            <a href="http://"></a>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">AdMin</span> </a>
                <div class="nav_list">
                    <a href="http://127.0.0.1:8000/sanpham" class="nav_link active"> <i
                            class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Quản lý sản phẩm</span>

                    </a>
                    <a href="http://127.0.0.1:8000/admin/qlloai/view" class="nav_link"><i
                            class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Quản lý loại sản phẩm</span></a>
                    <a href="http://127.0.0.1:8000/taikhoan" class="nav_link"><i class='bx bx-user nav_icon'></i> <span
                            class="nav_name">Quản lý tài khoản</span> </a>
                    <a href="http://127.0.0.1:8000/admin/qlbinhluan/view" class="nav_link"><i
                            class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name"> Quản lý bình
                            luận</span> </a>
                    <a href="http://127.0.0.1:8000/admin/qltintuc/view" class="nav_link"><i
                            class='bx bx-news nav_icon'></i> <span class="nav_name"> Quản lý tin tức</span> </a>
                    <a href="http://127.0.0.1:8000/khuyenmai" class="nav_link"><i class='bx bx-gift nav_icon'></i> <span
                            class="nav_name"> Quản lý khuyến mãi</span> </a>

                    <a href="http://127.0.0.1:8000/admin/qldonhang/view" class="nav_link"><i
                            class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Quản lý đơn hàng</span> </a>
                    <a href="http://127.0.0.1:8000/admin/qlphieunhap/view" class="nav_link"> <i
                            class='bx bx-folder nav_icon'></i> <span class="nav_name">Quản lý phiếu nhập</span> </a>
                    <a href="http://127.0.0.1:8000/admin/thongke/view" class="nav_link"><i
                            class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Thống kê</span> </a>
                </div>
            </div>
            <a href="" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
            </a>
        </nav>

    </div>

    <!--Container Main start-->
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
            </div>
        </div>
    </div>
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