<?php
class Usuario extends Model {
    public function cadastrar($nome, $email, $senha, $tel){
        $sql = $this->db->prepare('SELECT id FROM usuarios WHERE email = :email');
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() == 0){ // Se usuário não foi cadastrado, cadastra ele
            $sql = $this->db->prepare('INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha, telefone= :tel');
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':senha', md5($senha));
            $sql->bindValue(':email', $email);
            $sql->bindValue(':tel', $tel);
            $sql->execute();

            return true;
        }
        else{
            return false;
        }
    }

    public function entrar($email, $senha){
        $sql = $this->db->prepare('SELECT id FROM usuarios WHERE email = :email AND senha = :senha');
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        if ($sql->rowCount() != 0){
            // Salva sessão
            $sql = $sql->fetch();
            $_SESSION['userID'] = $sql['id'];

            return true;
        } else{
            return false;
        }
    }

    public function getName($id){
        $sql = $this->db->query("SELECT nome FROM usuarios WHERE id = '$id'");

        if ($sql->rowCount() == 0)
            return false;
        else
            return $sql->fetch()['nome'];
    }

    public function getTelefone($id){
        $sql = $this->db->query("SELECT telefone FROM usuarios WHERE id = '$id'");

        if ($sql->rowCount() == 0)
            return false;
        else
            return $sql->fetch()['telefone'];
    }

    public function countUsuarios(){
        $sql = $this->db->query("SELECT id FROM usuarios");
        return $sql->rowCount();
    }
}
?>