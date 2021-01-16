<?php
    require_once('config.php');

    if(isset($_REQUEST['btn_save'])) {
        try {
            $header = $_REQUEST['txt_header'];
            $summernote = $_REQUEST['txt_summernote'];

            if(!empty($header) && !empty($summernote)) {
                $sql = "INSERT INTO tbl_summernote(header, summernote) VALUES(:header, :summernote)";
                $insert_stmt = $db->prepare($sql);
                $insert_stmt->bindParam(':header', $header);
                $insert_stmt->bindParam(':summernote', $summernote);

                if($insert_stmt->execute()) {
                    echo "<script> alert('insert done!'); </script>";
                }
            }   
            else {
                echo "<script> alert('pls insert!'); </script>";
            }
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summernote</title>

    <!-- Summernote cdn -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action="" method="post" class="container">
        <h1>Summernote [Add]</h1>

        <div class="form-control">
            <h2>หัวข้อข่าว</h2>
            <input type="text" class="input_txt" name="txt_header" placeholder="กรอกหัวข้อข่าว">
        </div>

        <div class="form-control">
            <h2>เนื้อหาข่าว</h2>
            <textarea name="txt_summernote" id="summernote">

            </textarea>
        </div>

        <div class="form-button">
            <button name="btn_save" class="btn btn-save">บันทึก</button>
            <a href="get.php?id=1" class="btn btn-get">ดึงค่า</a>
        </div>
    </form>
    
    <script>
        $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
</body>
</html>