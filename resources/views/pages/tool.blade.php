@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')

    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="tools">Tools</a></li>
                <li class="breadcrumb-item active">TOOLNAAM</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-2">
                        <img id="toolLogo" src="img/logo-toolhub.png" class="img-responsive">
                    </div>
                    <div class="col-md-5">
                        <h1>ToolNaam</h1>

                     <!--   <script type="text/javascript">$("#input-id").rating();</script>-->

                        <input id="input-3" name="input-3" value="4" class="rating-loading">

                    </div>
                    <div class="align-self-end">
                        <a href="#" id="btnReport" class="btn" role="button">Fout melden</a>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="col-md">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#info">Informatie</a></li>
                                <li><a data-toggle="tab" href="#questions">Vragen</a></li>
                                <li><a data-toggle="tab" href="#pictures">Afbeeldingen</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="info" class="tab-pane fade in active">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et ultrices
                                        augue. Nam sit amet
                                        convallis diam,
                                        sed auctor tellus. Fusce at diam vitae ipsum ornare placerat. Class aptent
                                        taciti sociosqu ad
                                        litora torquent per
                                        conubia nostra, per inceptos himenaeos. Phasellus augue elit, cursus sit amet
                                        porta vitae,
                                        eleifend eget diam. Ut
                                        ut purus a purus laoreet imperdiet sed eget ante. Sed pellentesque ullamcorper
                                        commodo. Interdum
                                        et malesuada fames
                                        ac ante ipsum primis in faucibus.

                                        In hac habitasse platea dictumst. Donec eget pellentesque justo. Donec porttitor
                                        diam felis, sed
                                        bibendum ex convallis
                                        eu. Morbi efficitur accumsan orci eu ullamcorper. Ut et nisl vel nibh aliquam
                                        gravida a vel
                                        nunc. Mauris pellentesque
                                        egestas dolor eu facilisis. Vestibulum placerat eros bibendum leo rutrum
                                        ullamcorper. Integer
                                        orci neque, scelerisque
                                        nec purus quis, aliquam ultricies mauris. Nullam vestibulum urna in est cursus,
                                        rutrum tempor
                                        velit aliquam. Pellentesque
                                        habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                        Donec nec nulla
                                        eu nisi semper vulputate.
                                        Aenean eget ex faucibus, fermentum lectus ut, rhoncus mauris.

                                    </p>
                                </div>
                                <div id="questions" class="tab-pane fade">
                                    <h1> test</h1>
                                </div>
                                <div id="pictures" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="row"><img id="toolImage" src="img/logo-toolhub.png" class="img-thumbnail">  </div>
                                            <div class="row"><img id="toolImage" src="img/logo-toolhub.png" class="img-thumbnail">  </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row"><img id="toolImage" src="img/logo-toolhub.png" class="img-thumbnail">  </div>
                                            <div class="row"><img id="toolImage" src="img/logo-toolhub.png" class="img-thumbnail">  </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reactions" class="col-md-3">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et ultrices augue. Nam sit amet
                    convallis diam,
                    sed auctor tellus. Fusce at diam vitae ipsum ornare placerat. Class aptent taciti sociosqu ad litora
                    torquent per
                    conubia nostra, per inceptos himenaeos. Phasellus augue elit, cursus sit amet porta vitae, eleifend

                </p>
            </div>
        </div>
    </div>


@endsection
