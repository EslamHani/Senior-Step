<footer class="footer footer-black  footer-white ">
  <div class="container">
    <div class="row">
      <nav class="footer-nav">
        <ul>
          <li>
            <a href="{{ route('aboutus') }}" target="_self">About Us</a>
          </li>
          @foreach($pages as $page)
          <li>
            @php $page_name = trim(str_replace(' ', '_', $page->page_name)) @endphp
            <a href="{{ route('front.page', ['slug' => $page_name]) }}" target="_self">
              {{ $page->page_name }}
            </a>
          </li>
          @endforeach
        </ul>
      </nav>
      <div class="credits ml-auto">
        <span class="copyright">
          ©
          <script>
            document.write(new Date().getFullYear())
          </script>, made by Senior Step
        </span>
      </div>
    </div>
  </div>
</footer>