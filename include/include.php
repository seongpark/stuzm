<div id="loading"></div>
<script type="text/javascript">
        window.onbeforeunload = function () { $('#loading').show(); }  //현재 페이지에서 다른 페이지로 넘어갈 때 표시해주는 기능
        $(window).load(function () {          //페이지가 로드 되면 로딩 화면을 없애주는 것
            $('#loading').hide();
        });
    </script>