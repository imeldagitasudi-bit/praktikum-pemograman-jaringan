<?php
namespace Src\Repositories; use PDO; use Src\Config\Database;
class UserRepository{
    private PDO $db; public function __construct(array $cfg){ $this->db=Database::conn($cfg);}
    public function paginate($page,$per){
        $off = ($page-1)*$per; $total=(int)$this->db->query('SELECT COUNT(*) FROM users')->fetchColumn();
        $stmt=$this->db->prepare('SELECT id,name,email,role,created_at,updated_at FROM users ORDER BY id DESC LIMIT :per OFFSET :off');
        $stmt->bindValue(':per',(int)$per, PDO::PARAM_INT); $stmt->bindValue(':off',(int)$off,PDO::PARAM_INT); $stmt->execute();
        return ['data'=>$stmt->fetchAll(),'meta'=>['total'=>$total,'page'=>$page, 'per_page'=>$per, 'last_page'=>max(1, (int)ceil($total/$per))]];
    }
    public function find($id){ $s=$this->db->prepare('SELECT id,name,email,role,created_at,update_at FROM users WHERE id=?'); $s->execute([$id]); return $s->fetch(); }
    public function create($name,$email,$hash,$role='user'){
        $this->db->prepare('INSERT INTO users(name,email,role)')
    }
}