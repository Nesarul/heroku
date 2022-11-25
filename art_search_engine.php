<!DOCTYPE html>
<html lang="en">

<head>
    <title>Free Text-To-Speech (TTS)</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Free text-to-speech. Type something and our AI will read it out loud" name="description" />
    <meta content="text to speech, text to voice" name="keywords" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/756195da8b.js" crossorigin="anonymous"></script>
    
    <script data-ad-client="ca-pub-8348187590713387" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 
</head>
 
<body>
    <div class="container">
            <?php   include 'header.php'; ?>
        <div class="row">
            <div class="col text-center">
                <p class="h3"><strong>AI-Generated Art Search Engine</strong></p>
                <p class="mt-3">Type Your Text Below</p>
                
                <div class="col-sm-6 col-12 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6 offset-sm-2 col-9">
                            <input type="text" name="searchFor" id="searchFor" class="form-control border border-secondary shadow bg-body rounded" placeholder="Search for Images">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary form-control" id="sbtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<BR>
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" id="sld">
                        
                    </div>
                
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
<BR>
    </div>
    <script type="text/javascript">

        $('#searchFor').keypress(function(e){
            e.which == 13 ? $('#sbtn').trigger('click'):null;
        });

        $('#sbtn').on("click",function(){
            $.ajax({
                type    : 'POST',
                url     : "api_search_engine.php",
                async   : true,
                data    : {'crit':$('#searchFor').val()},
                dataType: "json",
                beforeSend : function (){
                    $("info-txt").removeClass("d-none").addClass('d-block');
                    $("#sub-text").html('Generating');
                },
                success : function (resp) {
                    $('#sld').empty();
                    var html = '';
                    if(resp === "E1")           // Reach 10 Limit
                        html = '<span class="text-danger">You have reached your limit of 10 images a day. Please try again tomorrow.</span>';
                    else if(resp === "E2")
                        html = "<span style='color:#f00'><strong>We do not allow NSFW (r-rated or offensive) content. Please try a different word or phrase.</strong></span>";
                    else{
                        $('#sld').empty();
                        var act = '<div class="carousel-item active">';
                        var nact = '<div class="carousel-item">';
                        $.each(resp.images,function(key,value){
                            if(key === 0)
                                html += act + '<img src="'+value['src']+'" class="d-block w-100" alt="'+value['src']+'"></div>';
                            else
                                html += nact + '<img src="'+value['src']+'" class="d-block w-100" alt="'+value['src']+'"></div>';
                        })
                    }
                    $('#sld').append(html);
                },
                error   : function (xhr, textStatus, errorThrown) {
                    alert("Someting wrong happen");
                },
                complete : function (){
                    $("#sub-text").html('Convert');
                    $("info-txt").addClass("d-none").removeClass('d-block');
                }
            });
        });
    </script>
    <BR>
<?php include 'footer_menu.php'; ?>
 <footer class="footer">
        <div class="content has-text-centered">
            <p>
                This text to voice program was built using <a href="https://github.com/coqui-ai/TTS" target="_blank"><strong>Coqui</strong></a>, which is licensed <a href="https://github.com/coqui-ai/TTS/blob/dev/LICENSE.txt" target="_blank">Mozilla Public License</a>.
            </p>
        </div>
    </footer>

</body>
</html>