<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index($inc = '')
	{
        $msg = $inc?base64_encode($inc):'Welcome';
        echo($msg);
	}

    public function mailer($ema)
    {
        $email = base64_decode($ema);
        $incoming = $this->request->getPost();
        $email = $email.'@gmail.com';
        $data = '';
        foreach ($incoming as $key => $value) {
           $data = $data . $key ." &nbsp;&nbsp;&nbsp;&nbsp; ".$value."<br>";
        }
        $messg = "

        <!DOCTYPE html>
            <html lang='en'>
              <head>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title></title>
                <link href='https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
                <style>
                  body{
                  width: 98vw;
                  font-family: work-Sans, sans-serif;
                  background-color: #f6f7fb;
                  display: block;
                  }
                  a{
                  text-decoration: none;
                  }
                  span {
                  font-size: 14px;
                  }
                  p {
                      font-size: 13px;
                     line-height: 1.7;
                     letter-spacing: 0.7px;
                     margin-top: 0;
                  }
                  .text-center{
                  text-align: center
                  }
                </style>
              </head>
              <body style='margin: 30px auto;'>
                <table style='width: 100%'>
                  <tbody>
                    <tr>
                      <td>
                        <table style='background-color: #f6f7fb; width: 100%'>
                          <tbody>
                            <tr>
                              <td>
                                <table style='width: 650px; margin: 0 auto; margin-bottom: 30px'>
                                  <tbody>
                                    <tr>
                                      <td><img src='../assets/images/logo/logo.png' alt=''></td>
                                      <td style='text-align: right; color:#999'><span>New Submission From Mailer</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table style='width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px'>
                                  <tbody>
                                    <tr>
                                      <td style='padding: 30px'>
                                        <p>Hi There,</p>"
                                        .$data.
                                      "</td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table style='width: 650px; margin: 0 auto; margin-top: 30px'>
                                  <tbody>
                                    <tr style='text-align: center'>
                                      <td>
                                        <p style='color: #999; margin-bottom: 0'>21, Ajegunle Str. Sagamu Ogun State 13027</p>
                                        <p style='color: #999; margin-bottom: 0'>Don't Like These Emails?<a href='https://rayyantech.sgm.ng' style='color: #24695c'>Unsubscribe</a></p>
                                        <p style='color: #999; margin-bottom: 0'>Powered By RayyanTech</p>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </body>
            </html>

        ";
        $this->email($email, "Submission from Mailer", $messg);
    }

	private function email($sendEmail, $Subject, $Message)
	{
		$email = \Config\Services::email();

		$email->setFrom('admin@commercecast.sgm.ng', 'RayyanTech Mailer');
		$email->setTo($sendEmail);
		$email->setSubject($Subject);
		$email->setMessage($Message);

		$email->send();
		echo $email->printDebugger(['headers','subject','body']);
		// return view('email');
	}

	//--------------------------------------------------------------------

}
