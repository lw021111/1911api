<!DOCTYPE html>
<html lang="zh">
<head>
    <base href="/status/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>接口展示</title>
    <link rel="icon" href="favicon.ico" type="image/ico">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid p-t-15">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>编号</th>
                                <th>接口名称</th>
                                <th>接口路径</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="">登录接口</a>
                                </td>
                                <td>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination">
                        <li class="disabled"><span>«</span></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#!">»</a></li>
                    </ul>

                </div>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.search-bar .dropdown-menu a').click(function() {
            var field = $(this).data('field') || '';
            $('#search-field').val(field);
            $('#search-btn').html($(this).text() + ' <span class="caret"></span>');
        });
    });
</script>
</body>
</html>
