<?php

require_once('Database.class.php');
require_once('phpmailer/PHPMailerAutoload.php');

class Coordinator extends Database{
    public function getCoordinators(){
        $sql = "SELECT * FROM tbl_coordinator ORDER BY coordinator_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCoordinator($id){
        $sql = "SELECT * FROM tbl_coordinator WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getCoordinatorByOrganization($id){
        $sql = "SELECT * FROM tbl_coordinator WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function createCoordinator($email, $first_name, $last_name, $contact_number, $organization_id){
        if(empty($email) || empty($first_name) || empty($last_name) || empty($contact_number) || empty($organization_id)){
            $_SESSION['error'] = 'All fields are required.';
            header('Location: coordinators.php');
            exit();
        }else {
            $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();

            if($result){
                $_SESSION['error'] = 'Email already exists.';
                header('Location: coordinators.php');
            }else{
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $password = array();
                $alphaLength = strlen($alphabet) - 1;
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $password[] = $alphabet[$n];
                }
                $password = implode($password);
                $sql = "INSERT INTO tbl_user (user_email, user_password, user_role) VALUES (?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$email, $password, 'Coordinator']);

                $user_id = $this->connection->lastInsertId();

                $sql = "INSERT INTO tbl_coordinator (coordinator_id, first_name, last_name, contact_number, organization_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$user_id, $first_name, $last_name, $contact_number, $organization_id]);

                $this->SendMail($email, 'OJT RMS ACCOUNT VERIFICATION', 'Coordinator Account Created', $first_name . ' ' . $last_name, $password, $otp);

                $_SESSION['success'] = 'Coordinator successfully created.';
                header('Location: coordinators.php');
            }
        }
    }

    public function SendMail($to, $fromName, $subject, $full_name, $password, $otp)
   {
      $mail = new PHPMailer;

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';

      $mail->Username = 'ronancolins38@gmail.com';
      $mail->Password = 'olujepniarizbvon';

      $mail->setFrom('ronancolins38@gmail.com', $fromName);
      $mail->addAddress($to);

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = '
            <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                <div style="margin:50px auto;width:70%;padding:20px 0">
                    <div style="border-bottom:1px solid #eee">
                        <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                        '.$subject.'
                        </a>
                    </div>
                    <p style="font-size:1.1em">
                    Hello, '.$full_name.'
                    </p>
                    <p>
                    Your account has been created. Please use the following credentials to login.
                    </p>
                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                    Password : '.$password.'
                    </h2><br />
                    <p style="font-size:0.9em;">Regards,<br />
                    OJT RMS
                    </p><br />
                    Please do not reply to this email. This is an automated email and you will not receive a response. If you have any questions, please contact us at 
                    <a href="mailto:ortegacanillo76@gmail.com">
                    Here
                    </a>
                    <hr style="border:none;border-top:1px solid #eee" />
                    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                        <p>
                        OJT RMS
                        </p>
                        <p>
                        6038, Toledo City, Cebu
                        </p>
                        <p>
                        Philippines
                        </p>
                    </div>
                </div>
            </div>
            ';

      if (!$mail->send()) {
         return false;
      } else {
         return true;
      }
   }

    public function updateCoordinator($coordinator_id, $email, $first_name, $last_name, $contact_number, $organization_id){
        $sql = "UPDATE tbl_user SET user_email = ? WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email, $coordinator_id]);

        $sql = "UPDATE tbl_coordinator SET first_name = ?, last_name = ?, contact_number = ?, organization_id = ? WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$first_name, $last_name, $contact_number, $organization_id, $coordinator_id]);

        $_SESSION['success'] = 'Coordinator successfully updated.';
        header('Location: coordinator.php?coordinator_id=' . $coordinator_id);
    }

    public function deleteCoordinator($id){
        $sql = "DELETE FROM tbl_coordinator WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $sql = "DELETE FROM tbl_user WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Coordinator successfully deleted.';
        header('Location: coordinators.php');
    }
}