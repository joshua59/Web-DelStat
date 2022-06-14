<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
<script src="{{asset('js/auth.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/regex.js')}}"></script>
<script src="{{asset('js/plugin.js')}}"></script>
<script src="{{asset('js/toastr.js')}}"></script>
        <script type="text/javascript">
            $("body").on("contextmenu", "img", function(e) {
                return false;
            });
            $('img').attr('draggable', false);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script type="text/javascript">
            $("#username_login").focus();
            username('username_login');
            $('#form_login').on('keydown', 'input', function (event) {
                if (event.which == 13) {
                    event.preventDefault();
                    var $this = $(event.target);
                    var index = parseFloat($this.attr('data-login'));
                    $('[data-login="' + (index + 1).toString() + '"]').focus();
                }
            });
            $('#form_register').on('keydown', 'input', function (event) {
                if (event.which == 13) {
                    event.preventDefault();
                    var $this = $(event.target);
                    var index = parseFloat($this.attr('data-register'));
                    $('[data-register="' + (index + 1).toString() + '"]').focus();
                }
            });
            format_email('email_register');
        </script>
<!--end::Page Custom Javascript-->