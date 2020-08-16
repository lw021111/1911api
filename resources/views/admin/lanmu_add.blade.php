<!DOCTYPE html>
<html lang="zh">
<head>
    <base href="/status/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>创建栏目 - 1904PHP博客管理系統</title>
    <link rel="icon" href="favicon.ico" type="image/ico">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">
    <!--标签插件-->
    <link rel="stylesheet" href="js/jquery-tags-input/jquery.tagsinput.min.css">
    <link href="css/style.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid p-t-15">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form action="#!" method="post" class="row">

                        <div class="form-group col-md-12">
                            <label for="title">栏目名称</label>
                            <input type="text" class="form-control" id="title" name="title" value="" placeholder="请输入栏目名称" />
                        </div>

                        <div class="form-group col-md-12">
                            <label for="sort">排序</label>
                            <input type="text" class="form-control" id="sort" name="sort" value="0" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="status">状态</label>
                            <div class="clearfix">
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" name="status" value="0"><span>禁用</span>
                                </label>
                                <label class="lyear-radio radio-inline radio-primary">
                                    <input type="radio" name="status" value="1" checked><span>启用</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">确 定</button>
                            <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返 回</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!--标签插件-->
<script src="js/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>