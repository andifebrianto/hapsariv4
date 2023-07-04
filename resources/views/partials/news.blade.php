<!-- News Section -->
<section id="news">
    <div class="container text-center">
        <h6 class="section-subtitle text-center">Our Activity</h6>
        <h6 class="section-title mb-6 text-center"><a style="text-decoration: none; color:#343a40;"
                href="/news">News</a></h6>

        <div class="row">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-md-4">
                    <div class="card blog-post my-4 my-sm-5 my-md-0">
                        <img src="imgs/blog-1.jpg"
                            alt="Download free bootstrap 4 landing page, free boootstrap 4 templates, Download free bootstrap 4.1 landing page, free boootstrap 4.1.1 templates, Creative studio Landing page">
                        <div class="card-body">
                            <div class="details mb-3">
                                <a href="javascript:void(0)"><i class="ti-comments"></i> 123</a>
                                <a href="javascript:void(0)"><i class="ti-eye"></i> 123</a>
                            </div>
                            <h5 class="card-title">Possimus aliquam veniam</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae laudantium
                                dolor
                                nisi obcaecati, non laboriosam asperiores doloremque tempora repellendus iure!</p>
                            <a href="javascript:void(0)" class="d-block mt-3">Read More...</a>
                        </div>
                    </div>
                </div>
            @endfor

        </div>
        <a class="btn btn-secondary mt-3" href="/news">Go to Article Page</a>
    </div>
</section>
<!-- End of News Section -->