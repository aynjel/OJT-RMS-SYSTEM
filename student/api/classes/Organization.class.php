<?php

require_once('../../classes/Database.class.php');


class Organization extends Database{
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
}