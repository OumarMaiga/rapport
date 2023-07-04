<?php

namespace Model;

use Sabo\Model\Attribute\TableColumn;
use Sabo\Model\Attribute\TableName;
use Sabo\Model\Cond\DatetimeCond;
use Sabo\Model\Cond\PrimaryKeyCond;
use Sabo\Model\Cond\RegexCond;
use Sabo\Model\Model\SaboModel;

/**
 * model
 * @name TemplateModel
 */
#[TableName("template")]
class TemplateModel extends SaboModel
{
	#[TableColumn("id",false,new PrimaryKeyCond(true, false))]
	protected string $id;

	#[TableColumn("title",true,new RegexCond(".{2,255}", "Erreur sur le title"))]
	protected ?string $title = NULL;

	#[TableColumn("slug",true,new RegexCond(".{2,255}", "Erreur sur le slug"))]
	protected ?string $slug = NULL;
	
	#[TableColumn("overview",false,new RegexCond(".{2,}", "Erreur sur la description"))]
	protected string $overview;

	#[TableColumn("status",false,new RegexCond("^[0|1]$", "Erreur sur le statut"))]
	protected int $status = 1;

	#[TableColumn("catalog_id",true,new RegexCond(".{2,255}", "Erreur sur le catalog_id"))]
	protected ?string $catalog_id = NULL;

	#[TableColumn("created_by",true,new RegexCond("^[0-9]*$", "Erreur sur l'utilisateur de création"))]
	protected ?int $created_by = NULL;

	#[TableColumn("created_at",false,new DatetimeCond())]
	protected string $created_at;

	#[TableColumn("updated_at",true,new DatetimeCond())]
	protected ?string $updated_at = NULL;

	public function create():bool
	{
		$this->created_by = 0;
		$this->created_at = date("Y-m-d H:i:s");

		return parent::insert();
	}

	public function update():bool
	{
		$this->updated_at = date("Y-m-d H:i:s");
		//var_dump($this);die;
		return parent::update();
	}
}