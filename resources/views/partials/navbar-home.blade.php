<!-- Page Navigation -->
<nav class="navbar custom-navbar navbar-expand-lg navbar-dark" data-spy="affix" data-offset-top="20">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="imgs/hapsari8.png" alt="">
        </a>
        <button class="navbar-toggler my-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Gallery</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#library">Library</a>
                    </li>

                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="#article">Article</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#news">News</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="">Blog</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="https://rumahsenihapsari56.blogspot.com/">Blog</a>
                    </li>
                @endauth
                <!-- <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-sm ml-lg-3" href="">Login</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
<!-- End Of Page Navigation -->
