<?php
namespace axl\fstore\model;

use \axolotl\util\Doctrine;

/**
 * @Entity
 * @Table(name="axl_fstore_files",
 *  uniqueConstraints={
 *    @UniqueConstraint(name="axl_fstore_file_unique",
 *      columns={"name", "fgroup"}
 *    )
 *  }
 * )
 */
class File{
  /** @Id @Column(type="integer") @GeneratedValue */
  protected $id;

  /** @Column(type="text", nullable=true) */
  protected $title;

  /** @Column(type="text", nullable=false) */
  protected $name;

  /** @Column(type="text", name="fgroup", nullable=true) */
  protected $group;

  /** @Column(type="blob", nullable=false) */
  protected $content;

  public function __construct($id=-1, $title="", $name="", $group="", $content=""){
    $this->id = $id;
    $this->title = $title;
    $this->name = $name;
    $this->group = $group;
    $this->content = $content;
  }

  public static function get(int $id){
    $em = Doctrine::getEntityManager();
    return $em->find(File::class, $id);
  }

  public static function getAll(string $group = null){
    $em = Doctrine::getEntityManager();
    if($group === null){
      return $em->getRepository(File::class)->findAll();
    }
    $group = strtolower($group);
    $qb = $em->createQueryBuilder();
    return $qb
      ->select('f')
			->from(File::class, 'f')
			->where(
				$qb->expr()->eq('f.group', ':group')
			)
			->setParameter('group', $group)
			->getQuery()
      ->getResult();
  }

  public function save(): void{
    $em = Doctrine::getEntityManager();
    $em->persist($this);
    $em->flush();
  }

  /*
    getter and setter
  */

  public function getID(): int{
    return $this->id;
  }

  public function setTitle(string $title){
    $this->title = $title;
    return $this;
  }
  public function getTitle() :string{
    return $this->title;
  }

  public function setName(string $name){
    $this->name = $name;
    return $this;
  }
  public function getName() :string{
    return $this->name;
  }

  public function setGroup(string $group){
    $this->group = strtolower($group);
    return $this;
  }
  public function getGroup() :string{
    return $this->group;
  }

  public function setContent($content){
    if(is_resource($content)){
      $this->content = stream_get_contents($content);
    }
    else{
      $this->content = $content;
    }
    return $this;
  }
  public function getContentString() :string{
    if(is_resource($this->content)){
      $str = stream_get_contents($this->content);
      rewind($this->content);
      return $str;
    }
    return $this->content;
  }
  public function getContentStream(){
    if(is_resource($this->content)){
      rewind($this->content);
      return $this->content;
    }
    $handle = fopen('php://tmp', 'w+');
    fwrite($handle, $this->content);
    rewind($handle);
    return $handle;
  }
}
