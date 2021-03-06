<?php

class Customer extends BaseModel {

    public $id, $name, $email, $address, $number, $email_consent, $address_consent, $number_consent, $sms_consent, $thirdparty_consent, $created, $modified, $modifier;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_email', 'validate_number', 'validate_address');
    }

    public static function say_hi() {
        return 'Hello World!';
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Customer');
        $query->execute();
        $rows = $query->fetchAll();
        $customers = array();

        foreach ($rows as $row) {

            $customers[] = new Customer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'address' => $row['address'],
                'number' => $row['number'],
                'email_consent' => $row['email_consent'],
                'address_consent' => $row['address_consent'],
                'number_consent' => $row['number_consent'],
                'sms_consent' => $row['sms_consent'],
                'thirdparty_consent' => $row['thirdparty_consent'],
                'created' => $row['created'],
                'modified' => $row['modified'],
                'modifier' => $row['modifier']
            ));
        }

        return $customers;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $customer = new Customer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'address' => $row['address'],
                'number' => $row['number'],
                'email_consent' => $row['email_consent'],
                'address_consent' => $row['address_consent'],
                'number_consent' => $row['number_consent'],
                'sms_consent' => $row['sms_consent'],
                'thirdparty_consent' => $row['thirdparty_consent'],
                'created' => $row['created'],
                'modified' => $row['modified'],
                'modifier' => $row['modifier']
            ));

            return $customer;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Customer (name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent, created) VALUES (:name, :email, :address, :number, :email_consent, :address_consent, :number_consent, :sms_consent, :thirdparty_consent, LOCALTIMESTAMP) RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'address' => $this->address, 'number' => $this->number, 'email_consent' => $this->email_consent, 'address_consent' => $this->address_consent, 'number_consent' => $this->number_consent, 'sms_consent' => $this->sms_consent, 'thirdparty_consent' => $this->thirdparty_consent));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Customer SET name=:name, email=:email, address=:address, number=:number, email_consent=:email_consent, address_consent=:address_consent, number_consent=:number_consent, sms_consent=:sms_consent, thirdparty_consent=:thirdparty_consent, modified=LOCALTIMESTAMP, modifier=:modifier WHERE id=:id RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'address' => $this->address, 'number' => $this->number, 'email_consent' => $this->email_consent, 'address_consent' => $this->address_consent, 'number_consent' => $this->number_consent, 'sms_consent' => $this->sms_consent, 'thirdparty_consent' => $this->thirdparty_consent, 'modifier' => $this->modifier, 'id' => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Customer WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_address() {
        if (!is_null($this->address) || $this->address != "") {
            $validateAddress = 'validate_length';
            $errors = $this->{$validateAddress}($this->address);
        } 
        return $errors;
    }

}
