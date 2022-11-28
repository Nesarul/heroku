<!DOCTYPE html>
<html lang="en">

<head>
    <title>Text-To-Image Generator</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Type what you want your image to look like and our AI will create it for you." name="description" />
    <meta content="text to image, image generator" name="keywords" />
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    
    <!-- Bootstrap -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <!-- File Input -->
    <script src="./js/piexif.min.js"></script>
    <script src="./js/fileinput.min.js"></script>
    <link rel="stylesheet" href="./js/fileinput.min.css">
    <link rel="stylesheet" href="./js/theme.css">
    <script src="./js/theme.js"></script>
    <script src="https://kit.fontawesome.com/756195da8b.js" crossorigin="anonymous"></script>
    
<script data-ad-client="ca-pub-8348187590713387" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'header.php';?>
        <div class="row">
            <div class="col-12 col-sm-6 offset-sm-3 text-center">
                <p class="h3"><strong>Text-To-Image Generator</strong></p>
                <p class="mt-3">Type what you want to see and our AI will create 4 different images for you:</p>

                <div class="mb-3">
                    <label for="imageFile" class="form-label">Choose your image</label>
                    <input class="form-control" type="file" id="imageFile" name="imageFile" accept="image/jpg,image/png,image/jpeg,image/gif"/>        
                </div>
                
                <button type="submit" name="submit" id="generate-text" class="btn btn-primary mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>&nbsp;&nbsp; Generate The 4 Images!
                </button>
            </div>
        </div>
<BR>
        <div class="row">
            <div class="col">
                <div id="model-output" class="column text-center">
                    <div id="tutorial" class="subtitle">
                        <em>Your 4 Images Will Appear Here In Around 20-30 Seconds!</em>
                        <div id="model-output"></div>
                    </div>
                    <div id="erMsg"></div>
                    <div id="kv-success-2"></div>
                </div>
            </div>
        </div>
<BR>
        <div class="row">
            <div class="col text-center">
                <p>Note: To save an image to share on social media, right click on it, click "Save Image As...", and save it to your pc or mobile device. Our text-to-image generator is based on the open-source <a href="https://stability.ai/blog/stable-diffusion-public-release" target="new">Stable Diffusion</a> code from Stability AI and uses an API from <a href="https://deepai.org/machine-learning-model/stable-diffusion" target="new">DeepAI</a>. 
                
                 By using our version of their program, you must agree to their license terms at <a href="https://huggingface.co/spaces/CompVis/stable-diffusion-license" target="new">Stable Diffusion</a>. Both non-commercial and commercial usage is allowed but you can't use it to deliberately produce nor share illegal or harmful outputs or content. We claim no rights on the output you generate. You are free to use the images and are accountable for their use which must not go against the provisions set in the license.</p>
                
                 <div class="col text-center">Keep in mind one of the benefits of a text-to-image generator is that you can use it to create images that are artistically creative, such as "a puppy flying a spaceship". You can also stylize the image so instead of just typing "Elon Musk" you might for example use one of these phrases:<BR>
A painting of Elon Musk<BR>
Oil painting of Elon Musk<BR>
Cartoon version of Elon Musk<BR>
Anime version of Elon Musk<BR>
Painting of Elon Musk fantasy style<BR>
Painting of Elon Musk futuristic style<BR>
Painting of Elon Musk psychedelic style<BR>
Painting of Elon Musk mosaic style<BR>
Painting of Elon Musk funky style<BR>
Painting of Elon Musk Rembrandt style<BR>
Painting of Elon Musk Kandinsky style<BR>
Painting of Elon Musk Cubist style<BR>
Painting of Elon Musk trippy style<BR>
Painting of Elon Musk pop art style<BR>
Painting of Elon Musk Native American style<BR>
Painting of Elon Musk Impressionist style<BR>
Painting of Elon Musk Degas style<BR>
Painting of Elon Musk Cezanne style<BR>
Painting of Elon Musk Matisse style<BR>
Painting of Elon Musk French style
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#imageFile").fileinput({
                theme:'fa6',
                uploadUrl: "api_text-to-image.php",
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                overwriteInitial: false,
                maxFileSize:100000,
                maxFilesNum:1,
                validateInitialCount: true,
                uploadAsync: false,
                elErrorContainer: '#erMsg',
                maxImageHeight: 512,
                resizeImage: true,
            }).on('filebatchpreupload', function(event, data, id, index) {
                $('#kv-success-2').html('<h4>Upload Status</h4><ul></ul>').hide();
            }).on('filebatchuploadsuccess', function(event, data) {
                var out = '<img src="'+data.response.output_url+'" alt="" width=500/>';
                
                $('#kv-success-2').append(out);
                $('#kv-success-2').fadeIn('slow');
            });
        });
    </script>
    <BR>
<?php include 'footer_menu.php'; ?>
</body>
</html>