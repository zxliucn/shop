
<div class="row-fluid">
    <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="#">Themedesigner.in</a> </div>
</div>

<!--end-Footer-part-->
<script>//百度统计可去掉
    var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
<script src="{{  URL::asset('admin/js/excanvas.min.js') }}" ></script>
<script src="{{  URL::asset('admin/js/jquery.min.js') }}"></script>
<script>
    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();</script>
<script src="{{  URL::asset('admin/js/jquery.ui.custom.js') }}" ></script>
<script src="{{  URL::asset('admin/js/bootstrap.min.js') }}" ></script>
{{--<script src="{{  URL::asset('admin/js/jquery.flot.min.js') }}" ></script>--}}
{{--<script src="{{  URL::asset('admin/js/jquery.flot.resize.min.js') }}" ></script>--}}
<script src="{{  URL::asset('admin/js/jquery.peity.min.js') }}" ></script>
<script src="{{  URL::asset('admin/js/fullcalendar.min.js') }}"></script>
<script src="{{  URL::asset('admin/js/matrix.js') }}" ></script>
{{--<script src="{{  URL::asset('admin/js/matrix.dashboard.js') }}" ></script>--}}
<script src="{{  URL::asset('admin/js/jquery.gritter.min.js') }}" ></script>
<script src="{{  URL::asset('admin/js/matrix.interface.js') }}" ></script>
<script src="{{  URL::asset('admin/js/matrix.chat.js') }}" ></script>
<script src="{{  URL::asset('admin/js/jquery.validate.js') }}" ></script>
<script src="{{  URL::asset('admin/js/matrix.form_validation.js') }}" ></script>
<script src="{{  URL::asset('admin/js/jquery.wizard.js') }}" ></script>
<script src="{{  URL::asset('admin/js/jquery.uniform.js') }}" ></script>
<script src="{{  URL::asset('admin/js/select2.min.js') }}" ></script>
<script src="{{  URL::asset('admin/js/matrix.popover.js') }}" ></script>
<script src="{{  URL::asset('admin/js/jquery.dataTables.min.js') }}" ></script>
<script src="{{  URL::asset('admin/js/matrix.tables.js') }}" ></script>

<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>
</body>
</html>
