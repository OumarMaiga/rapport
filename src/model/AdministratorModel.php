<?php

namespace Model;

use Sabo\Model\Attribute\TableColumn;
use Sabo\Model\Attribute\TableName;
use Sabo\Model\Cond\PrimaryKeyCond;
use Sabo\Model\Cond\RegexCond;
use Sabo\Model\Model\SaboModel;

/**
 * model
 * @name AdministratorModel
 */
#[TableName("administrator")]
class AdministratorModel extends SaboModel{
	#[TableColumn("id",false,new PrimaryKeyCond(true))]
	protected int $id;

	#[TableColumn("username",false,new RegexCond(".{2,30}", "Erreur sur le username"))]
	protected string $username;
}