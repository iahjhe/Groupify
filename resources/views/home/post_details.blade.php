<!DOCTYPE html>
<html lang="en">
   <head>
      <base href="/public">
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
 
      </div>
      <div class="container">
        <div class="row justify-content-center">
           <div class="col-md-4 d-flex flex-column align-items-center text-center">
              <div>
                 <img src="/postimage/{{$post->image}}" class="services_img" style="max-width: 100%; height: auto;">
              </div>
              <h4><b>{{$post->title}}</b></h4>
              <p>{{$post->description}}</p>
              <p>Post by <b>{{$post->name}}</b></p>
           </div>
        </div>
     </div>
    
{{-- 
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="input_btn_main">
               <input type="text" class="mail_text" placeholder="Enter your email" name="Enter your email">
               <div class="subscribe_bt"><a href="#">Subscribe</a></div>
            </div>
            <div class="location_main">
               <div class="call_text"><img src="images/call-icon.png"></div>
               <div class="call_text"><a href="#">Call +01 1234567890</a></div>
               <div class="call_text"><img src="images/mail-icon.png"></div>
               <div class="call_text"><a href="#">demo@gmail.com</a></div>
            </div>
            <div class="social_icon">
               <ul>
                  <li><a href="#"><img src="images/fb-icon.png"></a></li>
                  <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                  <li><a href="#"><img src="images/linkedin-icon.png"></a></li>
                  <li><a href="#"><img src="images/instagram-icon.png"></a></li>
               </ul>
            </div>
         </div>
      </div> --}}
      <!-- footer section end -->
      <!-- copyright section start -->
      @include('home.footer')   
   </body>
</html>