</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="assets/admin/js/jquery-1.10.2.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
<script src="assets/admin/js/bootstrap.min.js"></script>
<script src="assets/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Page-Level Plugin Scripts - Dashboard -->
<script src="assets/admin/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/admin/js/plugins/morris/morris.js"></script>
<script src="{{ asset('assets/admin/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/js/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('assets/admin/js/printThis.min.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>--}}



<!-- SB Admin Scripts - Include with every page -->
<script src="assets/admin/js/sb-admin.js"></script>

<!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
<script src="assets/admin/js/demo/dashboard-demo.js"></script>


<script src="js/toastr.min.js"></script>

@yield('js')


<script>
    @if(Session::has('suc'))
        toastr.success("{{ Session::get('suc') }}");
    @endif

    @if(Session::has('inf'))
        toastr.info("{{ Session::get('inf') }}");
    @endif

    @if(Session::has('err'))
    toastr.error("{{ Session::get('err') }}");
    @endif

    @if(count($errors) > 0)
        @foreach($errors->all() as $err)
            toastr.error("{{ $err }}")
        @endforeach
    @endif
</script>
</body>

</html>
