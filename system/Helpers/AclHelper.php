<?php

/**
 * Arquivo: AclHelper.php (UTF-8)
 *
 * Data: 28/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */
/* * ************************************************************************
 *
 * Acl Class provides a lightweight and flexible access control list (ACL) 
 * implementation for privileges management. In general, an application 
 * may utilize such ACL's to control access to certain protected objects 
 * by other requesting objects.
 * 
 *    A resource is an object to which access is controlled.
 * 
 *    A role is an object that may request access to a Resource.
 * 
 * Put simply, roles request access to resources. For example, if a parking 
 * attendant requests access to a car, then the parking attendant is the 
 * requesting role, and the car is the resource, since access to the car 
 * may not be granted to everyone.
 * 
 * Through the specification and use of an ACL, an application may 
 * control how roles are granted access to resources.
 * 
 * Based on:
 * http://framework.zend.com/manual/en/zend.acl.introduction.html
 *
 * Since i don't have Zend I amde my own ACL class
 *
 * *********************************************************************** */

namespace Core\Helpers;

/**
 * Class AclHelper
 * @package Core\Helpers 
 */
class AclHelper {

    protected $roles = array();
    protected $resources = array();
    protected $access = array();

    function __construct() {
        
    }

    public function addResource($resources) {
        if (is_string($resources)) {
            $this->resources[$resources] = '';
        } else if (is_array($resources)) {
            foreach ($resources as $resource) {
                $this->resources[$resource] = '';
            }
        }
    }

    public function addRole($role, $parents = '') {
        if (is_string($parents)) {
            if ($parents == '') {
                $this->roles[$role] = array();
            } else {
                $this->roles[$role][] = $parents;
            }
        } else if (is_array($parents)) {
            foreach ($parents as $parent) {
                $this->roles[$role][] = $parent;
            }
        } else {
            throw new Exception('Error: Não foi possível adicionar o rol');
        }
    }

    public function deny($role, $resources) {
        if (is_string($resources)) {
            $this->setAccess($role, $resources, 'deny');
        } else if (is_array($resources)) {
            foreach ($resources as $resource) {
                $this->setAccess($role, $resource, 'deny');
            }
        }
    }

    public function allow($role, $resources) {
        if (is_string($resources)) {
            $this->setAccess($role, $resources, 'allow');
        } else if (is_array($resources)) {
            foreach ($resources as $resource) {
                $this->setAccess($role, $resource, 'allow');
            }
        }
    }

    private function setAccess($role, $resource, $access = 'deny') {
        if ($this->checkIfRoleExist($role) || $this->checkIfResourceExist($resource)) {
            $this->access[$role][$resource] = $access;
        }
    }

    /**
     * Este método permite checar se o 'Rol' tem direito de acesso aos recursos
     * 
     * @param $role (String), $resource (String)
     * @return BOOL 
     */
    public function isAllowed($role, $resource) {
        //We first check that the resource & role exist
        if ($this->checkIfRoleExist($role) && $this->checkIfResourceExist($resource)) {
            //He has access to something
            if (array_key_exists($role, $this->access)) {
                //Maybe to this resource
                if (array_key_exists($resource, $this->access[$role])) {
                    //Is he allowed
                    if ($this->access[$role][$resource] == 'allow') {
                        return true;
                    }

                    //If he is not allowe we return false
                    if ($this->access[$role][$resource] == 'deny') {
                        return false;
                    }
                }
            }

            //Maybe a parent...?
            if (count($this->roles[$role]) > 0) {
                //We ask his parents                
                foreach ($this->roles[$role] as $parent) {
                    //We go deeper in the rabbit hole...
                    if ($this->isAllowed($parent, $resource)) {
                        return true;
                    }
                }
            }
        }
        //If we arrive here it means that he's not allowed
        return false;
    }

    /*     * ***************************************** */
    /*              METODOS PRIVATE             */
    /*     * ***************************************** */

    /*
      Checa se o role existe
     */

    private function checkIfRoleExist($role) {
        return array_key_exists($role, $this->roles);
    }

    /*
      Checa se o recurso existe
     */

    private function checkIfResourceExist($resource) {
        return array_key_exists($resource, $this->resources);
    }

    /* private function getResource($role,$resource)
      {
      if(array_key_exist($role,$this->access)
      } */

    /*     * ***************************************** */
    /*           METODOS SOBRECARGADOS          */
    /*     * ***************************************** */

    public function __toString() {
        $html = '<ul><h1>Roles disponíveis</h1>';

        foreach ($this->roles as $role => $parents) {
            $html .= '<li>' . $role . '<br />';

            foreach ($parents as $parent) {
                $html .= '<i>Herda de</i>  ' . $parent . '</li>';
            }

            $html .= '</li>';
        }

        $html .= '</ul>
                <ul><h1>Recursos disponíveis</h1>';

        foreach ($this->resources as $resource => $parent) {
            $html .= '<li>' . $resource . '</li>';
        }

        return $html . '</ul>';
    }

}
