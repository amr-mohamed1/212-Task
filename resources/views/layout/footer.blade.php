<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>

{{--    ************** bootstrap ***************--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

{{--    ************** DataTable ***************--}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>



<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>

<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

@stack('js')


</body>
</html>
