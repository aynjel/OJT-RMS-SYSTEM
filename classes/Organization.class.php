<?php

require_once('Database.class.php');

class Organization extends Database{
    public function getOrganizations(){
        $sql = "SELECT * FROM tbl_organization ORDER BY organization_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getOrganization($id){
        $sql = "SELECT * FROM tbl_organization WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getOrganizationByOrganizationName($organization_name){
        $sql = "SELECT * FROM tbl_organization WHERE organization_name = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_name]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createOrganization($organization_name, $organization_description, $organization_contact_number, $organization_address, $organization_email){
        $sql = "INSERT INTO tbl_organization (organization_name, organization_description, organization_contact_number, organization_address, organization_email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_name, $organization_description, $organization_contact_number, $organization_address, $organization_email]);

        if($stmt){
            $_SESSION['success'] = 'Organization created successfully';
            header('Location: index.php');
        }else{
            $_SESSION['error'] = 'Something went wrong. Please try again.';
            header('Location: index.php');
        }
    }

    public function updateOrganization($organization_name, $organization_description, $organization_contact_number, $organization_address, $organization_email, $id){
        $sql = "UPDATE tbl_organization SET organization_name = ?, organization_description = ?, organization_contact_number = ?, organization_address = ?, organization_email = ? WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_name, $organization_description, $organization_contact_number, $organization_address, $organization_email, $id]);

        if($stmt){
            $_SESSION['success'] = 'Organization updated successfully';
            header('Location: organization.php?organization_id='.$id);
        }else{
            $_SESSION['error'] = 'Something went wrong. Please try again.';
            header('Location: index.php');
        }
    }

    public function deleteOrganization($id){
        $sql = "DELETE FROM tbl_organization WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        if($stmt){
            $_SESSION['success'] = 'Organization deleted successfully';
            header('Location: index.php');
        }else{
            $_SESSION['error'] = 'Something went wrong. Please try again.';
            header('Location: index.php');
        }
    }
}