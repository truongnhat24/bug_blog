<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add blog</title>
	<link href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <section class="container">
        <h1 class="text-center">ADD NEW BLOG</h1>
        
        <form name="" action="" method="post">
            <div class="row mb-3">
                <label for="title-blog">Title</label>
                <div>
                    <input type="text" id="title-blog">
                </div>
            </div>

            <div class="row mb-3 flex-column">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10 image-upload">
                    <input name="image" type="file" class="form-control" id="image" placeholder="image">
                    <img src="<?php if (!empty($data['image'])) {
                        echo "media/upload/" .$this->controller.'/'.$data['image']; 
                    } else { echo "media/img/image_default.png";}?>" 
                    alt="<?php echo $data['name']; ?>" class="img-thumbnail profile-image">
                </div>
            </div>

            <div class="row mb-3">
                <label for="content-blog"></label>
                <div>
                    <textarea name="content-blog" id="content-blog"></textarea>
                </div>
            </div>
        </form>
    </section>

<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo RootREL; ?>media/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content-blog');
</script>
</body>
</html>



