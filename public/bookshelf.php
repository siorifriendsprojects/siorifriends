<!--<?php

// $mysql = new mysqli($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'],
//     $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE_NAME']);
//
// $sql = "INSERT INTO hoges(created_at) VALUES('" . date('Y-m-d H:i:s') . "')";
//
// $result = $mysql->query($sql);
//
// $sql = "SELECT * FROM hoges ORDER BY hoge_id desc limit 1";
//
// $result = $mysql->query($sql)->fetch_row();
//
// mysqli_close($mysql);
//var_dump($result);
?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/default.css" rel="stylesheet">
    <link href="css/hamburger.css" rel="stylesheet">

    <title>栞ふれんず。</title>
</head>


<header class="container-fluid">
        <div class="row">
            <div class="col-xs-3 icon-btn">
                <button class="btn bg-white hum-btn">
                    <span class="glyphicon glyphicon-align-justify"></span>
                    <span class="glyphicon glyphicon-remove" style="display:none;color:white;"></span>
                </button>
                <nav class="drawr">
                <div class="row">
                    <div class="col-xs-offset-5">
                        <img src="img/siori_face.png" alt="しおり" class="img-circle img-responsive img-icon" />
                    </div>
                    <div class="col-xs-12" style="color:white;text-align:center;">
                        User name<br>
                        account ID
                    </div>
                </div>   
                <ul id="menu">
                    <li><a href="#">本棚</a></li>
                    <li><a href="#">お気に入り</a></li>
                    <li><a href="#">設定</a></li>
                    <li><a href="#">ヘルプ</a></li>
                    <li><a href="#">ログアウト</a></li>
                </ul>
            </nav>
            </div>
            <div class="col-xs-6 logo-btn">
                <button><img src="img/logo01.png" alt="タイトルロゴ" class="img-responsive"></img></button>
            </div>
            <div class="col-xs-3" id="sn-icon" style="padding-left:0px;">
                <div class="row">
                    <div class="col-xs-4 icon-btn" style="">
                        <button class="btn bg-white"><span class="glyphicon glyphicon-search"></span></button>
                    </div>  
                    <div class="col-xs-4 col-xs-offset-1 icon-btn">
                        <button class="btn bg-white"><span class="glyphicon glyphicon-bell"></span></button>
                    </div>
                    <div class="col-xs-4">
                    </div>
                </div>
            </div>
        </div>
    </header>


<body>


    <form class="form-inline">
        <div class="col-xs-12 center">

            <div class="bg-success">
                    <div class="col-xs-6">   
                        <label for="selection">ソート:</label>
                            <select id="selection" class="form-control">
                                <option>昇順
                                <option>降順
                                <option>新着順
                            </select>
                    </div>

                    <div class="col-xs-6">
                        <label for="name">絞込:</label>
                        <input type="text" id="refine" class="form-control">
                    </div>
            </div>
        </div>
    </form>
    
        <div class="col-xs-12 container">
            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
<script src="js/drawr.js"></script>
</body>
<footer>
        
</footer>
</html>
