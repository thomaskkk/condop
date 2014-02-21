<?php




class Morador extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;
     
    /**
     *
     * @var string
     */
    protected $Nome;
     
    /**
     *
     * @var string
     */
    protected $Cpf;
     
    /**
     *
     * @var string
     */
    protected $Rg;
     
    /**
     *
     * @var string
     */
    protected $TelContato;
     
    /**
     *
     * @var string
     */
    protected $Email;
     
    /**
     *
     * @var string
     */
    protected $DataNasc;
     
    /**
     *
     * @var string
     */
    protected $Foto;
     
    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field Nome
     *
     * @param string $Nome
     * @return $this
     */
    public function setNome($Nome)
    {
        $this->Nome = $Nome;

        return $this;
    }

    /**
     * Method to set the value of field Cpf
     *
     * @param string $Cpf
     * @return $this
     */
    public function setCpf($Cpf)
    {
        $this->Cpf = $Cpf;

        return $this;
    }

    /**
     * Method to set the value of field Rg
     *
     * @param string $Rg
     * @return $this
     */
    public function setRg($Rg)
    {
        $this->Rg = $Rg;

        return $this;
    }

    /**
     * Method to set the value of field TelContato
     *
     * @param string $TelContato
     * @return $this
     */
    public function setTelcontato($TelContato)
    {
        $this->TelContato = $TelContato;

        return $this;
    }

    /**
     * Method to set the value of field Email
     *
     * @param string $Email
     * @return $this
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * Method to set the value of field DataNasc
     *
     * @param string $DataNasc
     * @return $this
     */
    public function setDatanasc($DataNasc)
    {
        $this->DataNasc = $DataNasc;

        return $this;
    }

    /**
     * Method to set the value of field Foto
     *
     * @param string $Foto
     * @return $this
     */
    public function setFoto($Foto)
    {
        $this->Foto = $Foto;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field Nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->Nome;
    }

    /**
     * Returns the value of field Cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->Cpf;
    }

    /**
     * Returns the value of field Rg
     *
     * @return string
     */
    public function getRg()
    {
        return $this->Rg;
    }

    /**
     * Returns the value of field TelContato
     *
     * @return string
     */
    public function getTelcontato()
    {
        return $this->TelContato;
    }

    /**
     * Returns the value of field Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Returns the value of field DataNasc
     *
     * @return string
     */
    public function getDatanasc()
    {
        return $this->DataNasc;
    }

    /**
     * Returns the value of field Foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->Foto;
    }

}
