// import $ from "jquery";

$( document ).ready(function(){

    // switching to mini admin sidebar
    var toggler = $('.admin-sidebar .sidebar-toggle');
    var sidebar = $('.admin-sidebar');

    toggler.click(function(){
        sidebar.toggleClass('mini-admin-sidebar')
    })

    // sidebar menu
    var menu_items = $('#sidebar-menu .item');
    menu_items.each(function(index){
    var link = $(this).find('a.title');
    var subMenu = $(this).find('ul.sub-menu');
    var subMenuWrap = $(this).find('div.sub-menu-wrap');
    var animateClass = 'animate_animated animate__tada';


        // click on menu item
        $(this).click(function(e){
            var siblings = $(this).siblings();
            // reset styles to default
            $(this).siblings().removeClass('active');
            
            $(this).siblings().each((i)=>{
                var sibling = siblings[i];
                var subMenuWrap = $(sibling).find('div.sub-menu-wrap');
                $(subMenuWrap[0]).css('max-height', 0)
            })

            
            $(this).toggleClass('active');
            if($(this).hasClass('active')){
                $(subMenuWrap[0]).css('max-height', $(subMenuWrap[0]).prop('scrollHeight') + 10 + 'px'); 
                // animate
                $(subMenuWrap[0]).addClass(animateClass)
            }else{
                $(subMenuWrap[0]).css('max-height', 0); 
                $(subMenuWrap[0]).removeClass(animateClass)
            }
            
            
        })
         // if submenu exists , link will be prevented
        if(subMenuWrap.length > 0){
            link.click(function(e){
                e.preventDefault()
            })
        }

    });
    // console.log(menu_items)
})