<div class="container">

    @if(!isset($data))
    <?php $data = $_REQUEST; ?>
    @endif

    @if (isset($data['tid']))
    <?php $_tid=$data['tid']; ?>
    @else
    <?php $_tid=''; ?>
    @endif


    @if (isset($data['logo_hidden']))
    <?php $_logo=url("uploads")."/".$data['logo_hidden']; ?>
    @else
    <?php $_logo=''; ?>
    @endif


    @if (isset($data['company_name']))
    <?php $_cname=$data['company_name']; ?>
    @else
    <?php $_cname=''; ?>
    @endif


    @if (isset($data['usp']))
    <?php $_usp=$data['usp']; ?>
    @else
    <?php $_usp=''; ?>
    @endif


    @if (isset($data['repair']))
    <?php $_repair=$data['repair']; ?>
    @else
    <?php $_repair=''; ?>
    @endif


    @if (isset($data['remote']))
    <?php $_remote=$data['remote']; ?>
    @else
    <?php $_remote=''; ?>
    @endif


    @if (isset($data['service']))
    <?php $_service=$data['service']; ?>
    @else
    <?php $_service=''; ?>
    @endif


    @if (isset($data['since']))
    <?php $_year=$data['since']; ?>
    @else
    <?php $_year=''; ?>
    @endif


    @if (isset($data['contact_pic']))
    <?php $_pic= url("uploads")."/".$data['contact_pic']; ?>
    @else
    <?php $_pic=''; ?>
    @endif


    @if (isset($data['fname']))
    <?php $_fname=$data['fname']; ?>
    @else
    <?php $_fname=''; ?>
    @endif


    @if (isset($data['lname']))
    <?php $_lname=$data['lname']; ?>
    @else
    <?php $_lname=''; ?>
    @endif


    @if (isset($data['city']))
    <?php $_city=$data['city']; ?>
    @else
    <?php $_city=''; ?>
    @endif


    @if (isset($data['phone']))
    <?php $_phone=$data['phone']; ?>
    @else
    <?php $_phone=''; ?>
    @endif


    @if (isset($data['email']))
    <?php $_email=$data['email']; ?>
    @else
    <?php $_email=''; ?>
    @endif

    @if (isset($data['url']))
    <?php $_url=$data['url']; ?>
    @else
    <?php $_url=''; ?>
    @endif


    @if (isset($data['description']))
    <?php $_desc=$data['description']; ?>
    @else
    <?php $_desc=''; ?>
    @endif
    <!-- Top row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-xs-12 col-md-6">
            <!-- Display logo ONLY if it exists in the database -->
            @if (trim($_logo)!='')
                <img class="techlogo" style="width: auto !important;" src="{!!  $_logo  !!}">
            @endif
            <img id="techLogoPreview" style="margin-top: 20px;padding-bottom: 25px;" src="">

            <h3 class="cname" id="compNamePreview"><span>{!! $_cname !!}</span></h3>
            <h4 class="text-right usp" id="uspPreview"><span>{!! $_usp !!}</span></h4>
        </div>
        <div class="col-xs-12 col-md-6">
            <center>
                <!-- Display avatar ONLY if there is no picture in the database -->
                @if(trim($_pic)!='')
                    <img class="contactPic" id="contactPicPreview" src="{!!  $_pic  !!}">
                @else
                    <img class="contactPic" id="contactPicPreview" src="<?php echo url('uploads'); ?>/no-image.gif">
                @endif
            </center>
        </div>
    </div>

    <!-- Middle row -->
    <div class="row">
        <!-- Left side -->
        <div class="col-xs-12 col-md-6">
            <div class="row"> <!-- nested row -->
                <div class="col-xs-6 text-right">
                    <h4>Services include -</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>
                        <img id="repairPreview" src="">
                        @if ($_repair == '0')
                            <img class="redX" src="<?php echo url('assets/front'); ?>/images/redCheckbox18px.png">
                        @else
                            <img class="greenCk" id="dontShow" src="<?php echo url('assets/front'); ?>/images/greenCheckmark20px.png">
                        @endif
                    </h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4>Repair Center</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>
                        <img id="remotePreview" src="">
                        @if ($_remote == '0')
                            <img class="redX" src="<?php echo url('assets/front'); ?>/images/redCheckbox18px.png">
                        @else
                            <img class="greenCk" id="dontShowR" src="<?php echo url('assets/front'); ?>/images/greenCheckmark20px.png">
                        @endif
                    </h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4>Remote Assistance</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>
                        <img id="servicePreview" src="">
                        @if ($_service == '0')
                            <img class="redX" src="<?php echo url('assets/front'); ?>/images/redCheckbox18px.png">
                        @else
                            <img class="greenCk" id="dontShowS" src="<?php echo url('assets/front'); ?>/images/greenCheckmark20px.png">
                        @endif
                    </h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4>On-site Service</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 text-right">
                    <h4 id="sincePreview">{!! $_year !!} years in business</h4>
                </div>
            </div>
        </div>

        <!-- Right side -->
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>Contact:</h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4 id="techUserName">{!! $_fname !!} <?php echo ' ';?> {!! $_lname !!} </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>Location:</h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4 id="locationPreview">{!! $_city !!}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>Phone:</h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4 id="phonePreview">{!! $_phone !!}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>E-mail:</h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4><a id="emailPreview" href="mailto:{!! $_email !!}">Click to Send</a></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 text-right">
                    <h4>Website:</h4>
                </div>
                <div class="col-xs-offset-6">
                    <h4><a id="webPreview" href="http://{!! $_url !!}" target="_blank">Click to Open</a></h4>
                </div>
            </div>
        </div>
        <!-- Bottom row -->
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <h4 id="descPreview">{!! $_desc!!}</h4>
            </div>
        </div>
    </div>
</div>
<style>
    .gm_li, ul li {
        list-style: disc outside none !important;
        padding-bottom: 6px;
    }
    ul {
        margin-left: 40px;
    }
</style>