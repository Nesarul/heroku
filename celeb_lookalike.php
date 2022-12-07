<!DOCTYPE html>
<html lang="en">

<head>
    <title>Celebrity Lookalikes</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Which celebrity do you look like? Upload your photo to find out." name="description" />
    <meta content="celeb look alikes, celebs, dopplegangers" name="keywords" />
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="js/fileinput.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="js/piexif.min.js"></script>
    <script src="js/fileinput.js"></script>


    <script data-ad-client="ca-pub-8348187590713387" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <style>
        .image-list{
    list-style-type: none;
    text-align:left;
}
.image-list img{
    width:100px;
    height:100px;
    display: inline;
    margin:5px 20px 5px 5px;
    border:5px solid #fff;
    box-shadow: 3px 3px 10px 0px rgba(0,0,0,0.75);
    -webkit-box-shadow: 3px 3px 10px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 3px 3px 10px 0px rgba(0,0,0,0.75);
}
.image-list span a{
    font-size:25px;
    text-decoration:none;
    color:#f60;
    vertical-align:top;
}
    </style>
</head>
<body>
    <div class="container">
            <?php   include 'header.php'; ?>
        <div class="row">
            <div class="col text-center">
                <p class="h3"><strong>Celebrity Lookalike Finder</strong></p>
                <p class="mt-3">Which celeb do you look like? To find out, upload your photo (jpg, jpeg, png or gif format) and make sure you face is clearly showing (no hat or hoodie, try not to be too close to the camera, and make sure you are the only person in the photo). Note: So our servers don't get overloaded, we have a limit of 10 photo submissions a day per user for this page and some of the other pages on BoredHumans.com combined.</p>
                
                <div class="col-sm-6 col-12 col-md-4 offset-md-4 offset-sm-3">
                    <div class="file-loading">
                        <input id="fileCust" name="fileCust" type="file">
                    </div>
                </div>
                
            </div>
        </div>
<BR>
        <div class="row">
            <div class="col">
                <div id="model-output" class="column text-center">
                    <div id="tutorial" class="subtitle">
                        <em>Your Celebrity Face Matches Will Appear Here In Around 10 Seconds! [Note: Sometimes it gives an error because it can not detect your face. If that happens, try again with a different photo]</em>
                        
                        <div id="model-output"></div>
                        <div id="erMsg" style="margin-top:10px;display:none"></div>
                        <div id="upSucc" class="alert alert-success" style="margin-top:10px;display:none"></div>
                    </div>
                </div>
            </div>
        </div>
<BR>
    </div>

    <script type="text/javascript">
$('document').ready(function() {
    var sna = $('#adCt').val(); // for access control / security 
    $("#fileCust").fileinput({
        theme:'fa',
        uploadExtraData: function (previewId, index) {
            var obj = {};
            $('.adcont').find('input').each(function() {
                var id = $(this).attr('id'), val = $(this).val();
                obj[id] = val;
            });
            return obj;
        },
        uploadUrl: "api_celeb_lookalike.php",
        allowFileExtensions: ['jpg','jpeg','png','gif'],
        overwriteInitial: false,
        maxFileSize:100000,
        maxFilesNum:1,
        validateInitialCount: true,
        uploadAsync: false,
        elErrorContainer: '#erMsg',
        maxImageHeight: 512,
        resizeImage: true,
        showPreview: false,
        showRemove: false,
        uploadLabel: "Submit",
    }).on('filebatchpreupload', function(event, data, id, index) {
        $('#upSucc').html('<h4>Here Are Your Celebrity Matches</h4><span></span>').hide();
    }).on('filebatchuploadsuccess', function(event, data) {
        $('#upSucc span').append(data.response);
        $('#upSucc').fadeIn('slow');
    });
});

</script>
    <BR>
<?php include 'footer_menu.php'; ?>

 <footer class="footer">
        <div class="content has-text-centered">
            <p>
                This transcript generator was made using <a href="https://github.com/ageitgey/face_recognition" target="_blank"><strong>Face Recognition</strong></a>,                 , which is licensed <a href="https://github.com/ageitgey/face_recognition/blob/master/LICENSE" target="_blank">MIT</a>.
            </p>
        </div>
    </footer>

</body>
</html>