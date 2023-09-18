<style>
#slideLeft{
      position: absolute;
      left: 0%;
        top: 10px;
    border: none;
    background: none;
    font-size: 18px;
  color:#ef3d23;
  z-index: 9999;
  }
 #slideRight{
      position: absolute;
      right: 0%;
        top: 10px;
    border: none;
    background: none;
    font-size: 18px;
   color:#ef3d23;
   z-index: 9999;
  }
  /* @media (max-width: 1000px){
  #slideLeft{
   display:none;
  }
 #slideRight{
     display:none;
  }
  } */


ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.navwrap {
 
  margin: auto;
  overflow:hidden;
  white-space: nowrap;
 /* -webkit-overflow-scrolling: touch; seems to confine overflow in error  */
  padding-bottom: 14px;
}

.nav {
  display: table; /*white-space fix*/
  width: 100%;
  text-align: center;
  word-spacing: -9em; /*white-space fix*/
}
.nav li {
  display: inline-block;
  text-align: left;
  word-spacing: normal; /*white-space fix*/
}
.nav li > a {
  position: relative;
}
.nav li:hover,
.nav > li > a:hover,
.nav li:focus,
.nav > li > a:focus {
  z-index: 105;
}
.nav li li {
  display: block;
}
.nav a {
  display: block;
  padding: 7px 10px;
  background: rgb(255, 255, 255);
  color: rgb(0, 0, 0);
  border: 1px solid rgb(255, 255, 255);
  text-decoration: none;
  white-space: nowrap;
  position: relative;
}
.nav li:hover > a,
.nav a:hover,
.nav li:focus > a,
.nav a:focus {
  background: rgb(255, 255, 255);
}
.nav ul {
  position: absolute;
  z-index: 104;
  left: -999em;
  top: 0;
  opacity: 0;
  transition: opacity 0.5s, left 0s 0.5s, top 0.5s;
}
.nav li:hover > ul {
  left: auto;
  top: auto;
  opacity: 1;
  transition: opacity 0.5s linear, top 0.5s;
}
.nav li:focus-within > ul {
  left: auto;
  top: auto;
  opacity: 1;
  transition: opacity 0.5s linear, top 0.5s;
}
.nav ul ul {
  transition: opacity 0.4s, left 0s 0.4s, margin 0s 0.4s;
  z-index: 103;
}
.nav li li:hover ul {
  top: auto;
  margin-left: 100%;
  transform: translateY(-2.2rem);
  opacity: 1;
  transition: opacity 0.5s linear, margin 0.5s;
}
.nav li li:focus-within ul {
  top: auto;
  margin-left: 100%;
  transform: translateY(-2.2rem);
  opacity: 1;
  transition: opacity 0.5s linear, margin 0.5s;
}

/* arrows 
.nav li a:first-child:not(:last-child) {
  padding-right: 20px; /* make space for arrows*/
}
/*.nav li a:first-child:not(:last-child):after {
  content: "";
  position: absolute;
  right: 3px;
  top: 50%;
  margin-top: -6px;
  width: 0;
  height: 0;
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-left: 6px solid #ef3d23;
}
.nav > li > a:first-child:not(:last-child):after {
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-top: 6px solid #ef3d23;
  border-bottom: none;
  margin-top: -3px;
}*/
.nav li:hover a:first-child:not(:last-child):after {
  border-left-color: #fff;
}
.nav li:focus-within a:first-child:not(:last-child):after {
  border-left-color: #fff;
}

.nav > li:hover > a:first-child:not(:last-child):after {
  border-left-color: transparent;
  border-top-color: #fff;
}
.nav > li:focus-within > a:first-child:not(:last-child):after {
  border-left-color: transparent;
  border-top-color: #fff;
}

/* allow touch to play but probably won't work with this scrolling version*/
.nav .touch-only {
  display: none;
  left: -10px;
}
.touch-device .nav .touch-only {
  display: inline-block;
}
.touch-device .nav .touch-only a {
  background: #000;
  color: #fff;
}

.wrap {
  padding: 20px;
  max-width: 980px;
  margin: auto;
  background: #eee;
}

/* remove hover when scrolling  */
.isScrolling .nav ul.dropdown{ 
  left: -999em;
  opacity:0;
}
  #container_f{
    display:none;
  }
  @media (min-width: 700px) and (max-width: 992px) {
 #container_f{
    display:none !important;
  }
     #container_k{
    display:block !important;
  }
    #slideLeft{
  display:block !important;
  }
 #slideRight{
 display:block !important;
  }
    .head-menu {
   
    margin-top: 15px !important;
}
  }
  @media (max-width: 1000px) {
   #container_f{
    display:block;
  }
     #container_k{
    display:none;
  }
    #slideLeft{
  display:none;
  }
 #slideRight{
 display:none;
  }
  }
  .nav li {
     margin-right: 5px !important;
}
}
</style>

<div class="head-menu">
  
    <div class="container-fluid" >
     
   <!--  <div class="row" >
       <div class="col-md-12" >
   <button id="slideLeft" type="button"><i class="fa fa-caret-left" aria-hidden="true"></i></button>
    <button id="slideRight" type="button"><i class="fa fa-caret-right" aria-hidden="true"></i></button> 
      </div></div> -->
      <nav class="navbar navbar-expand-lg mt-3" id="container_f">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span title="Open Main Navigation" class="relative">
                    <span class="app-menu-icon-initial absolute center-a"><svg aria-hidden="true" focusable="false"
                            data-prefix="far" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14 fa-fw fa-lg">
                            <path fill="currentColor"
                                d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"
                                class=""></path>
                        </svg>
                    </span>

                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" id="content_k" >
                    @foreach ($menu as $men)
                        @if ($men->menu_items->count() <= 0)
                            <li class="nav-item" style="border-bottom: 3px solid #f35b04;">

                                <a class="nav-link"
                                    @if ($men->type == 'route') {
                            href="#"
                            }
                            @elseif($men->type == 'none'){
                                                        href="{{ url($men->url ?? '#') }}"
                                                        }
                            @elseif($men->type == 'url'){
                                                        href="{{ url($men->url) }}"
                                                        }
                            @elseif($men->type == 'page'){
                                                        href="
                                                        {{ route('page-wise', $men->url) }}"
                                                        }
                            @elseif($men->type == 'category'){
                                                            href="{{ route('product-category-wise', $men->url) }}"
                                                            }
                            @elseif($men->type == 'sub-category'){
                            href="
                            {{ route('product-sub-category-wise', $men->url) }}
                            "
                            } @endif>
                                    {{ $men->menu_title }}
                                </a>
               
                            </li>
                        @else
                            <li class="nav-item dropdown" style="border-bottom: 3px solid #20245ce0;">
                              
                               
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="{{ $men->url }}">
                                    {{ $men->menu_title }}
                                </a>
                                @if ($men->mega_menu == 1)
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($men->menu_items as $items)
                                            <a class="dropdown-item"
                                                @if ($items->type == 'route') {
                                                href="
                                                {{-- {{route($items->url)}} --}}
                                                "
                                                }
                                                @elseif($items->type == 'none'){
                                                                                        href="{{ url($items->url) }}"
                                                                                        }
                                                @elseif($items->type == 'url'){
                                                                                        href="{{ url($items->url) }}"
                                                                                        }
                                                @elseif($items->type == 'page'){
                                                                                        {{-- If the segment of url is 'en' route will add en and if not will not add --}}
                                                                                        href="
                                                                                        {{ route('page-wise', $items->url) }}"
                                                                                        }
                                                @elseif($items->type == 'category'){
                                                                                            href="{{ route('product-category-wise', $items->url) }}"
                                                                                            }
                                                @elseif($items->type == 'sub-category'){
                                                href="
                                                {{ route('product-sub-category-wise', $items->url) }}
                                                "
                                                } @endif
                                                class="menu-li-color list-font-size">
                                                {{ $items->menu_item_title }}
                                      </a>
                                            <div class="dropdown-divider"></div>
                                        @endforeach
                                  </div>
                                @else
                             
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($men->menu_items as $items)
                                            <a class="dropdown-item"
                                                @if ($items->type == 'route') {
                                    href="
                                    "
                                        @elseif($items->type == 'none'){
                                                                            href="{{ url($items->url) }}"
                                                                            }
                                        @elseif($items->type == 'url'){
                                                                            href="{{ url($items->url) }}"
                                                                            }
                                        @elseif($items->type == 'page'){
                                                                            href="
                                                                            {{ route('page-wise', $items->url) }}"
                                                                            }
                                        @elseif($items->type == 'category'){
                                    href="
                                   #
                                    "
                                    }
                               @elseif($items->type == 'sub-category'){
                                        href="
                                        {{ route('product-category-wise', $items->url) }}
                                        "
                                        } @endif>
                                                {{ $items->menu_item_title }}

                                            </a>
                                            <div class="dropdown-divider"></div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </nav> 
        <div class="row" >
            <div class="col-md-12" >
        <button id="slideLeft" type="button"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
         <button id="slideRight" type="button"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></i></button> 
           </div></div>
  <div class="navwrap" id="container_k">

    <ul id="nav" class="nav" id="content_k">
     @foreach ($menu as $men)
       @if ($men->menu_items->count() <= 0)
    <li style="border-bottom: 3px solid #f35b04;">
      <a 
         @if ($men->type == 'route') {
        href="#"
        }
        @elseif($men->type == 'none'){
        href="{{ url($men->url ?? '#') }}"
        }
        @elseif($men->type == 'url'){
        href="{{ url($men->url) }}"
        }
        @elseif($men->type == 'page'){
        href="
        {{ route('page-wise', $men->url) }}"
        }
        @elseif($men->type == 'category'){
        href="{{ route('product-category-wise', $men->url) }}"
        }
        @elseif($men->type == 'sub-category'){
        href="
        {{ route('product-sub-category-wise', $men->url) }}
        "
        } @endif>
        {{ $men->menu_title }}
      </a>
     </li>
       @else
    
       <li style="border-bottom: 3px solid #20245ce0;">
         <a href="{{ $men->url }}"> {{ $men->menu_title }}  <i class="fa fa-chevron-down" aria-hidden="true" style="font-size: 11px;"></i></a>
         @if ($men->mega_menu == 1)
         <ul class="dropdown"> 
             <li>
          @foreach ($men->menu_items as $items)
            <a 
               @if ($items->type == 'route') {
              href=""
              }
              @elseif($items->type == 'none'){
              href="{{ url($items->url) }}"
              }
              @elseif($items->type == 'url'){
              href="{{ url($items->url) }}"
              }
              @elseif($items->type == 'page'){
              href="{{ route('page-wise', $items->url) }}"
              }
              @elseif($items->type == 'category'){
              href="{{ route('product-category-wise', $items->url) }}"
              }
              @elseif($items->type == 'sub-category'){
              href="{{ route('product-sub-category-wise', $items->url) }}"
              } @endif
              class="menu-li-color list-font-size">
              {{ $items->menu_item_title }}

            </a>
               
         @endforeach
              
            </li>
           
        </ul>
         
        @endif
         
      </li>
    
     @endif
    @endforeach
  </ul>
</div>
    </div>

</div>

<script>

  
const buttonRight = document.getElementById('slideRight');
const buttonLeft = document.getElementById('slideLeft');

 buttonRight.onclick = function () {
   document.getElementById('container_k').scrollLeft +=200;
  };
  buttonLeft.onclick = function () {
      document.getElementById('container_k').scrollLeft -=200;
   };
 
 (function () {
  // detect touch
  if ("ontouchstart" in document.documentElement) {
    document.documentElement.className += " touch-device";
  }

  const scroller = document.querySelector(".navwrap");
  const dropDown = document.querySelectorAll(".dropdown");
  scroller.addEventListener("scroll", checkScroll);

  function checkScroll() {
    document.activeElement.blur();
   scroller.classList.add("isScrolling");
    for (let i = 0; i < dropDown.length; i++) {
      dropDown[i].style.transform =
        "translateX(-" + scroller.scrollLeft + "px)";
    }
   scroller.classList.remove("isScrolling");
  }
})();
</script>
