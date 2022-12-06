<?php

class PageServer
{
    public function __construct() {   }

    public function homeLink():string {  return WEBROOT; }

    public function listUtilizadores():string {  return WEBROOT.'pages/utilizador/list_utilizadores.php'; }
    public function removerUtilizador($id):string {  return WEBROOT.'pages/utilizador/remover_utilizador.php?id='.$id; }
    public function editarUtilizador($id):string {  return WEBROOT.'pages/utilizador/editar_utilizador.php?id='.$id; }
    public function novoUtilizador():string {  return WEBROOT.'pages/utilizador/novo_utilizador.php'; }

    public function listProjetos():string {  return WEBROOT.'pages/projeto/list_projetos.php'; }
    public function removerProjeto($id):string {  return WEBROOT.'pages/projeto/remover_projeto.php?id='.$id; }
    public function novoProjeto():string {  return WEBROOT.'pages/projeto/novo_projeto.php'; }
    public function editarProjeto($id):string {  return WEBROOT.'pages/projeto/editar_projeto.php?id='.$id; }

    public function listTarefas():string {  return WEBROOT.'pages/tarefa/list_tarefas.php'; }
}

/**
 * @return PageServer
 */
function pageServer():PageServer { return new PageServer(); }