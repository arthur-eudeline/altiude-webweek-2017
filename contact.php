<?php 

    require('functions.php');
    require('config.php');

    get_header("Nous contacter");

?>
    
    <body class="page-contact container-fluid">
        
        
    <!-- NAVBAR -->
        <div class="row">
        <div class="col-md-12 navbar"></div>
        </div>
     <!-- FORMULAIRE -->
        <div class="row">
        <div class="container">
            <div class="col-xs-offset-1">
                <h3>Besoin d’un renseignement ? Envoyez-nous un message !</h3>
            </div>
            <div class="col-md-7 col-xs-offset-1 col-xs-11 box-shadow formulaire">
                <div class="col-md-7 col-xs-8">
                    <form action="/ma-page-de-traitement" method="post">
                        <div>
                            <p>Votre nom</p>
                            <input type="text" id="nom" class="box-answer" />
                        </div>
                        <div>
                            <p>Votre adresse email</p>
                            <input type="email" id="courriel" class="box-answer" />
                        </div>
                        <div>
                            <p>Message</p>
                            <textarea id="message" rows="6" class="box-answer"></textarea>
                        </div>
                        <button type="button" class="btn btn-vert"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> envoyer</button>
                    </form>
                </div>
                
                <div class="col-md-5 col-xs-4 photo">
                    
                    <!-- Image en background dans le CSS -->
                </div>
            </div>
        </div>
        </div>
        
        <!-- FOOTER -->
        <div class="row">
            <div class="col-xs-12 footer">
                <div class="row">
                    <div class="col-xs-offset-1 col-xs-4">
                        <h4>ALTI'UDE</h4>
                        <p>Et olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina sm eomnes tamen quotquot st vt otiosae sint tribus perecundum.</p>
                    </div>
                
                    <div class="col-md-offset-2 col-md-2 col-xs-offset-0 col-xs-4">
                        <h4>CONTACT</h4>
                        <p>4 rues des Lauriers <br>43 000 Le Puy en Velay</p>
                        <p>04 05 06 07 08 </p>
                        <p>alti’ude@contact.fr</p</p>
                    </div>
                
                    <div class="col-md-offset-1 col-md-1 col-xs-offset-0 col-xs-1">
                        <a href="#"><i class="fa fa-facebook-square fa-1x social-media" aria-hidden="true"></i></a><br>
                        <a href="#"><i class="fa fa-twitter fa-1x social-media" aria-hidden="true"></i></a><br>
                        <a href="#"><i class="fa fa-instagram fa-1x social-media" aria-hidden="true"></i></a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-1 col-md-offset-10 col-xs-3 col-xs-offset-9 copyright">
                    <p>2017 - Alti’ude ©</p>
                    </div>
                </div>
            </div> 
        </div>
        
        <!-- /FOOTER -->
        
    </body>
</html>