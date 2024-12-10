<section class="services-section py-5">
    <div class="container">
        <!-- Section Title -->
        <header class="text-center mb-5">
            <h1 class="mb-3">Blog Posts</h1>
            <p class="text-muted">
                Empowering students of King's College of the Philippines with personalized study and tutoring support tailored to your needs.
            </p>
        </header>
        <!-- Blog Posts Grid -->
        <div class="row g-4">
            @foreach($post as $post)
            <div class="col-md-6 col-lg-4">
                <article class="card h-100 shadow border-0">
                    <!-- Blog Image -->
                    <img 
                        src="/postimage/{{$post->image}}" 
                        alt="Image for {{$post->title}}" 
                        class="card-img-top" 
                        style="height: 200px; object-fit: cover;">
                    <!-- Blog Content -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2">{{$post->title}}</h5>
                        <p class="card-text text-muted">Post by <b>{{$post->name}}</b></p>
                        <p class="text-truncate" style="max-height: 3.5em; overflow: hidden;">{{$post->description}}</p>
                    </div>
                    <!-- Read More Button -->
                    <div class="card-footer bg-transparent border-0 text-center mt-auto">
                        <a href="{{url('post_details', $post->id)}}" class="btn btn-primary w-100" aria-label="Read more about {{$post->title}}">Read More</a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
