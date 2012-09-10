<?php

$config['rules']['contact'] =  array(
                                    'name' => array(
                                            'field' => 'name',
                                            'label' => 'Name',
                                            'rules' => 'required'
                                         ),
                                    'email' => array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'required|valid_email'
                                         ),
                                    'subject' => array(
                                            'field' => 'subject',
                                            'label' => 'Subject',
                                            'rules' => 'required'
                                         ),
                                    'message' => array(
                                            'field' => 'message',
                                            'label' => 'Message',
                                            'rules' => 'required'
                                         )
                                    );
?>