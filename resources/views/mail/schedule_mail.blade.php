{{-- <!DOCTYPE html>

<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta content="width=device-width" name="viewport" />
    <style>
        .bee-row,
        .bee-row-content {
            position: relative
        }

        .bee-row-1,
        .bee-row-10,
        .bee-row-11,
        .bee-row-12,
        .bee-row-13,
        .bee-row-14,
        .bee-row-15,
        .bee-row-16,
        .bee-row-2,
        .bee-row-3,
        .bee-row-4,
        .bee-row-5,
        .bee-row-6,
        .bee-row-7,
        .bee-row-8,
        .bee-row-9 {
            background-repeat: no-repeat
        }

        body {
            background-color: #390000;
            color: #000;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif
        }

        a {
            color: #8a3c90
        }

        * {
            box-sizing: border-box
        }

        body,
        h1,
        p {
            margin: 0
        }

        .bee-row-content {
            max-width: 1025px;
            margin: 0 auto;
            display: flex
        }

        .bee-row-content .bee-col-w1 {
            flex-basis: 8%
        }

        .bee-row-content .bee-col-w2 {
            flex-basis: 17%
        }

        .bee-row-content .bee-col-w3 {
            flex-basis: 25%
        }

        .bee-row-content .bee-col-w4 {
            flex-basis: 33%
        }

        .bee-row-content .bee-col-w5 {
            flex-basis: 42%
        }

        .bee-row-content .bee-col-w6 {
            flex-basis: 50%
        }

        .bee-row-content .bee-col-w8 {
            flex-basis: 67%
        }

        .bee-row-content .bee-col-w12 {
            flex-basis: 100%
        }

        .bee-button .content {
            text-align: center
        }

        .bee-button a,
        .bee-icon .bee-icon-label-right a {
            text-decoration: none
        }

        .bee-icon {
            display: inline-block;
            vertical-align: middle
        }

        .bee-icon .bee-content {
            display: flex;
            align-items: center
        }

        .bee-paragraph,
        .bee-text {
            overflow-wrap: anywhere
        }

        .bee-row-1 .bee-row-content,
        .bee-row-2 .bee-row-content {
            background-color: #390000;
            background-repeat: no-repeat;
            border-radius: 0;
            color: #000
        }

        .bee-row-11 .bee-row-content,
        .bee-row-12 .bee-row-content,
        .bee-row-3 .bee-row-content,
        .bee-row-4 .bee-row-content,
        .bee-row-5 .bee-row-content {
            background-color: #fff;
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-3 .bee-row-content {
            background-image: url('https://d1oco4z2z1fhwp.cloudfront.net/templates/default/7326/hero-background.png');
            background-size: auto;
            border-radius: 0
        }

        .bee-row-3 .bee-col-1 {
            padding-bottom: 20px;
            padding-right: 00px
        }

        .bee-row-3 .bee-col-2 {
            padding-bottom: 20px;
            padding-left: 10px;
            padding-right: 10px
        }

        .bee-row-3 .bee-col-2 .bee-block-2 {
            padding-bottom: 30px;
            text-align: center;
            width: 100%
        }

        .bee-row-3 .bee-col-2 .bee-block-3,
        .bee-row-4 .bee-col-1 .bee-block-1 {
            padding-bottom: 30px
        }

        .bee-row-3 .bee-col-2 .bee-block-4 {
            padding: 10px;
            text-align: center
        }

        .bee-row-3 .bee-col-3 {
            padding: 5px 30px
        }

        .bee-row-5 .bee-col-2 .bee-block-1 {
            padding-bottom: 30px;
            padding-left: 10px;
            padding-right: 10px
        }

        .bee-row-5 .bee-col-2 .bee-block-2 {
            padding: 10px 10px 30px;
            text-align: center
        }

        .bee-row-6 .bee-row-content,
        .bee-row-7 .bee-row-content {
            background-color: #fafafa;
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-10 .bee-row-content,
        .bee-row-8 .bee-row-content,
        .bee-row-9 .bee-row-content {
            background-color: #fafafa;
            background-repeat: no-repeat;
            border-radius: 0;
            color: #000
        }

        .bee-row-11 .bee-col-1 {
            padding: 30px
        }

        .bee-row-13 .bee-row-content {
            background-color: #fff;
            background-repeat: no-repeat;
            border-radius: 0;
            color: #000
        }

        .bee-row-14 .bee-row-content {
            background-color: #390000;
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-14 .bee-col-1 {
            padding: 30px 20px 10px
        }

        .bee-row-14 .bee-col-2 {
            padding: 30px 10px 10px
        }

        .bee-row-14 .bee-col-2 .bee-block-1,
        .bee-row-14 .bee-col-2 .bee-block-2,
        .bee-row-14 .bee-col-3 .bee-block-1,
        .bee-row-14 .bee-col-3 .bee-block-2,
        .bee-row-15 .bee-col-1 .bee-block-1 {
            padding: 10px
        }

        .bee-row-14 .bee-col-3,
        .bee-row-14 .bee-col-4 {
            padding: 30px 10px
        }

        .bee-row-15 .bee-row-content,
        .bee-row-16 .bee-row-content {
            background-repeat: no-repeat;
            color: #000
        }

        .bee-row-16 .bee-col-1 {
            padding-bottom: 5px;
            padding-top: 5px
        }

        .bee-row-16 .bee-col-1 .bee-block-1 {
            color: #9d9d9d;
            font-family: inherit;
            font-size: 15px;
            padding-bottom: 5px;
            padding-top: 5px;
            text-align: center
        }

        .bee-row-4 .bee-col-1 .bee-block-1 {
            color: #393d47;
            direction: ltr;
            font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 44px;
            font-weight: 700;
            letter-spacing: 0;
            line-height: 120%;
            text-align: center
        }

        .bee-row-3 .bee-col-2 .bee-block-3,
        .bee-row-5 .bee-col-2 .bee-block-1 {
            direction: ltr;
            font-weight: 400;
            letter-spacing: 0;
            line-height: 120%;
            text-align: left
        }

        .bee-row-3 .bee-col-2 .bee-block-3 a,
        .bee-row-4 .bee-col-1 .bee-block-1 a,
        .bee-row-5 .bee-col-2 .bee-block-1 a {
            color: #8a3b8f
        }

        .bee-row-3 .bee-col-2 .bee-block-3 p:not(:last-child),
        .bee-row-4 .bee-col-1 .bee-block-1 p:not(:last-child),
        .bee-row-5 .bee-col-2 .bee-block-1 p:not(:last-child) {
            margin-bottom: 16px
        }

        .bee-row-3 .bee-col-2 .bee-block-3 {
            color: #fff;
            font-size: 16px
        }

        @media (max-width:768px) {
            .bee-row-content:not(.no_stack) {
                display: block
            }

            .bee-row-3 .bee-col-2 .bee-block-2 h1,
            .bee-row-4 .bee-col-1 .bee-block-1 {
                font-size: 60px !important
            }
        }

        .bee-row-5 .bee-col-2 .bee-block-1 {
            color: #3c3c3c;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 23px
        }

        .bee-row-16 .bee-col-1 .bee-block-1 .bee-icon-image {
            padding: 5px 6px 5px 5px
        }

        .bee-row-16 .bee-col-1 .bee-block-1 .bee-icon:not(.bee-icon-first) .bee-content {
            margin-left: 0
        }

        .bee-row-16 .bee-col-1 .bee-block-1 .bee-icon::not(.bee-icon-last) .bee-content {
            margin-right: 0
        }
    </style>
</head>

<body>
    <div class="bee-page-container">
        <div class="bee-row bee-row-1">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:15px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-2">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:30px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-3">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w1">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w5">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                    <div class="bee-block bee-block-2 bee-heading">
                        <img src="{{ asset('frontend/assets/images/logo3.png') }}" alt="">
                        <h1
                            style="color:#FFF;direction:ltr;font-family:'Roboto Slab', Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:74px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                            Tahanan Real Estate<br /> </h1>
                    </div>
                    <div class="bee-block bee-block-3 bee-paragraph">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br />Enim nisl, eget dictum
                            consectetur integer lectus.</p>
                    </div>
                    <div class="bee-block bee-block-4 bee-button"><a class="bee-button-content"
                            href="{{ url('/') }}"
                            style="font-size: 14px; background-color: #C3203C; border-bottom: 0px solid transparent; border-left: 0px solid transparent; border-radius: 20px; border-right: 0px solid transparent; border-top: 0px solid transparent; color: #ffffff; direction: ltr; font-family: inherit; font-weight: 400; letter-spacing: 1px; max-width: 100%; padding-bottom: 5px; padding-left: 40px; padding-right: 40px; padding-top: 5px; width: auto; display: inline-block;"
                            target="_self"><span dir="ltr"
                                style="word-break: break-word; font-size: 14px; line-height: 200%; letter-spacing: 1px;">DISCOVER</span></a>
                    </div>
                </div>
                <div class="bee-col bee-col-3 bee-col-w6"></div>
            </div>
        </div>
        <div class="bee-row bee-row-4">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-paragraph">
                        <p>Welcome!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-5">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w8">
                    <div class="bee-block bee-block-1 bee-paragraph">
                        <p><strong>Good day, Maam/Sir!</strong><br /><strong>Your Request is confirm on this data. </strong></p>

                        <h3> Tour Date : {{ $schedule['tour_date'] }} </h3>
                        <h3> Tour Time : {{ $schedule['tour_time'] }}</h3>

                        <p>Aliquam purus commodo magnis ipsum dolor sit amet, consectetur adipiscing elit habitasse est
                            in rhoncus libero ut. Aenean viverra fermentum, volutpat, neque amet, justo.<br />Socis
                            natoqu eagnis dist mte dulmuese feugiata lecen erment.</p>
                    </div>
                    <div class="bee-block bee-block-2 bee-button"><a class="bee-button-content"
                            href="http://www.example.com"
                            style="font-size: 14px; background-color: #3c3c3c; border-bottom: 0px solid transparent; border-left: 0px solid transparent; border-radius: 20px; border-right: 0px solid transparent; border-top: 0px solid transparent; color: #ffffff; direction: ltr; font-family: inherit; font-weight: 400; letter-spacing: 1px; max-width: 100%; padding-bottom: 5px; padding-left: 40px; padding-right: 40px; padding-top: 5px; width: auto; display: inline-block;"
                            target="_self"><span dir="ltr"
                                style="word-break: break-word; font-size: 14px; line-height: 200%; letter-spacing: 1px;">READ
                                MORE</span></a></div>
                </div>
                <div class="bee-col bee-col-3 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-6">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12"></div>
            </div>
        </div>
        <div class="bee-row bee-row-7">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w8"></div>
                <div class="bee-col bee-col-3 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-8">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w4"></div>
                <div class="bee-col bee-col-3 bee-col-w4"></div>
                <div class="bee-col bee-col-4 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-9">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w4"></div>
                <div class="bee-col bee-col-3 bee-col-w4"></div>
                <div class="bee-col bee-col-4 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-10">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:60px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-11">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12"></div>
            </div>
        </div>
        <div class="bee-row bee-row-12">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
                <div class="bee-col bee-col-2 bee-col-w8"></div>
                <div class="bee-col bee-col-3 bee-col-w2">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-13">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-spacer">
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-14">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w3"></div>
                <div class="bee-col bee-col-2 bee-col-w3">
                    <div class="bee-block bee-block-1 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 120%; font-size: 12px; font-family: inherit; color: #fafafa;">
                            <p style="font-size: 14px; line-height: 16px; text-align: center;"><span
                                    style="font-size: 18px; line-height: 21px;"><strong style=""><span
                                            style="line-height: 14px;">About</span></strong></span></p>
                        </div>
                    </div>
                    <div class="bee-block bee-block-2 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 150%; font-size: 12px; font-family: inherit; color: #fafafa;">
                            <p style="line-height: 18px; text-align: center;"><span style="line-height: 18px;">Lorem
                                    ipsum dolor sit amet, adipiscing. </span></p>
                            <p style="line-height: 18px; text-align: center;"><span style="line-height: 18px;">Aenean
                                    eget scelerisque magna.</span></p>
                            <p style="line-height: 18px; text-align: center;"><span style="line-height: 18px;">Cras
                                    interdum do mattis eugravid. </span></p>
                        </div>
                    </div>
                </div>
                <div class="bee-col bee-col-3 bee-col-w3">
                    <div class="bee-block bee-block-1 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 120%; font-size: 12px; font-family: inherit; color: #fafafa;">
                            <p style="font-size: 14px; line-height: 16px; text-align: center;"><span
                                    style="font-size: 18px; line-height: 21px;"><strong style=""><span
                                            style="line-height: 14px;">Contact Us</span></strong></span></p>
                        </div>
                    </div>
                    <div class="bee-block bee-block-2 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 150%; font-size: 12px; font-family: inherit; color: #fafafa;">
                            <p style="line-height: 18px; text-align: center;"><span style="line-height: 18px;">Km 14 East Service Road, Western Bicutan, Taguig City, 1630, Philippines</span></p>
                            <p style="line-height: 18px; text-align: center;"><span
                                    style="line-height: 18px;">support@tahananrealestate.com </span></p>
                            <p style="line-height: 18px; text-align: center;"><span style="line-height: 18px;">(+63)
                                90945723657</span></p>
                        </div>
                    </div>
                </div>
                <div class="bee-col bee-col-4 bee-col-w3"></div>
            </div>
        </div>
        <div class="bee-row bee-row-15">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-text">
                        <div class="bee-text-content"
                            style="line-height: 120%; font-size: 12px; font-family: inherit; color: #868686;">
                            <p style="font-size: 14px; line-height: 16px; text-align: center;"><span
                                    style="font-size: 12px; line-height: 14px;">Tahanan Real Estate © 2023 All Right Reserved
                                    </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bee-row bee-row-16">
            <div class="bee-row-content">
                <div class="bee-col bee-col-1 bee-col-w12">
                    <div class="bee-block bee-block-1 bee-icons">
                        <div class="bee-icon bee-icon-last">
                            <div class="bee-content">
                                <div class="bee-icon-image"><a href="https://www.designedwithbee.com/"
                                        target="_blank" title="Designed with BEE"><img alt="Designed with BEE"
                                            height="32px" src="images/bee.png" width="auto" /></a></div>
                                <div class="bee-icon-label bee-icon-label-right"><a
                                        href="https://www.designedwithbee.com/" target="_blank"
                                        title="Designed with BEE">Designed with BEE</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<!--[if gte mso 9]>
	<xml>
		<o:OfficeDocumentSettings>
		<o:AllowPNG/>
		<o:PixelsPerInch>96</o:PixelsPerInch>
		</o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,700,700i" rel="stylesheet" />
    <!--<![endif]-->
	<title>Email Template</title>
	<!--[if gte mso 9]>
	<style type="text/css" media="all">
		sup { font-size: 100% !important; }
	</style>
	<![endif]-->
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none }
		a { color:#66c7ff; text-decoration:none }
		p { padding:0 !important; margin:0 !important } 
		img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
		.mcnPreviewText { display: none !important; }

				
		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			.bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }
			
			.text-header,
			.m-center { text-align: center !important; }
			
			.center { margin: 0 auto !important; }
			.container { padding: 20px 10px !important }
			
			.td { width: 100% !important; min-width: 100% !important; }

			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-top,
			.column-empty,
			.column-empty2,
			.column-dir-top { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 10px !important; }
			.column-empty2 { padding-bottom: 30px !important; }

			.content-spacing { width: 15px !important; }
		}
	</style>
</head>

<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#001736">
		<tr>
			<td align="center" valign="top">
				<table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
					<tr>
						<td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:55px 0px;">
							<!-- Header -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15" style="padding: 0px 30px 30px 30px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th class="column-top" width="145" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img m-center" style="font-size:0pt; line-height:0pt; text-align:left;"><img src="images/logo.jpg" width="131" height="38" border="0" alt="" /></td>
														</tr>
													</table>
												</th>
												<th class="column-empty" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
												<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="text-header" style="color:#475c77; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:16px; text-align:right;"><a href="#" target="_blank" class="link2" style="color:#475c77; text-decoration:none;"><span class="link2" style="color:#475c77; text-decoration:none;">Open in your browser</span></a></td>
														</tr>
													</table>
												</th>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Header -->

							<!-- Intro -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-bottom: 10px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td class="tbrr p30-15" style="padding: 60px 30px; border-radius:26px 26px 0px 0px;" bgcolor="#12325c">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="h1 pb25" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:40px; line-height:46px; text-align:center; padding-bottom:25px;">Welcome, Emily Garrett</td>
														</tr>
														<tr>
															<td class="text-center pb25" style="color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:25px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <span class="m-hide"><br /></span>tempor incididunt ut labore et dolore magna aliqua.</td>
														</tr>
														<!-- Button -->
														<tr>
															<td align="center">
																<table class="center" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
																	<tr>
																		<td class="pink-button text-button" style="background:#ff6666; color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:14px; line-height:18px; padding:12px 30px; text-align:center; border-radius:0px 22px 22px 22px; font-weight:bold;"><a href="{{ url('/') }}" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;"><span class="link-white" style="color:#ffffff; text-decoration:none;">Discover More</span></a></td>
																	</tr>
																</table>
															</td>
														</tr>
														<!-- END Button -->
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Intro -->

							<!-- Article / Full Width Image + Title + Copy + Button -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-bottom: 10px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#0e264b">
											<tr>
												<td class="fluid-img" style="font-size:0pt; line-height:0pt; text-align:left;"><img src="images/image1.jpg" width="650" height="366" border="0" alt="" /></td>
											</tr>
											<tr>
												<td class="p30-15" style="padding: 50px 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="h3 pb20" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:25px; line-height:32px; text-align:left; padding-bottom:20px;">Lorem ipsum dolor sit amet</td>
														</tr>
														<tr>
															<td class="text pb20" style="color:#ffffff; font-family:Arial,sans-serif; font-size:14px; line-height:26px; text-align:left; padding-bottom:20px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
														</tr>
														<!-- Button -->
														<tr>
															<td align="left">
																<table border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td class="blue-button text-button" style="background:#66c7ff; color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:14px; line-height:18px; padding:12px 30px; text-align:center; border-radius:0px 22px 22px 22px; font-weight:bold;"><a href="#" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;"><span class="link-white" style="color:#ffffff; text-decoration:none;">CLICK HERE</span></a></td>
																	</tr>
																</table>
															</td>
														</tr>
														<!-- END Button -->
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Article / Full Width Image + Title + Copy + Button -->

							<!-- Footer -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15 bbrr" style="padding: 50px 30px; border-radius:0px 0px 26px 26px;" bgcolor="#0e264b">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" style="padding-bottom: 30px;">
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/ico_facebook.jpg" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/ico_twitter.jpg" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/ico_instagram.jpg" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="38" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/ico_linkedin.jpg" width="38" height="38" border="0" alt="" /></a></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class="text-footer1 pb10" style="color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:20px; text-align:center; padding-bottom:10px;">Bussy - Free HTML Email Template</td>
											</tr>
											<tr>
												<td class="text-footer2" style="color:#8297b3; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:26px; text-align:center;">East Pixel Bld. 99, Creative City 9000, <br />Republic of Design</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="text-footer3 p30-15" style="padding: 40px 30px 0px 30px; color:#475c77; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:18px; text-align:center;">
										<a href="#" target="_blank" class="link2-u" style="color:#475c77; text-decoration:underline;"><span class="link2-u" style="color:#475c77; text-decoration:underline;">Unsubscribe</span></a> from this mailing list.
									</td>
								</tr>
							</table>
							<!-- END Footer -->
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>

