Uniform - Lightweight HTML Forms for [Kohana](http://kohanaframework.org)
=========================================================================

This module is experimental. 

Uniform builds on the premises that 

* forms should be fun again
* HTML generation follows DRY principles (ie. no code duplication)
* as much work as possible should be left to the framework (eg. Form and Validate classes)

Examples
--------

Once you added the Uniform module, making forms is easy:

1.    Create a Uniform_Fieldset class in 'application/classes/uniform/fieldset/':

    class Uniform_Fieldset_User extends Uniform_Fieldset {

        public function __construct()
        {
            //atm we suppose it's a mysql database
            parent::__construct('user_table', 'id');

            /* 
              The fields of user_table are added to our fieldset automatically
              In this simple table we only have 4 fields: id, name, password, email)
              These fields are now available to the fieldset. 
              They are available as Uniform_Field according to the MySQL type they have. 
            */
            
            //we can customize some of them if we like
  
            $this->field('name')
                    ->hname('Username')
                    ->params(array(   //the arguments array that is passed to Kohana's Form::input
                        'size'=> 30         
                    ))
                  
                  ->field('email')
                    ->rule('email'); //the rule is set in Kohana's Validate library
        }

    }
    
2.    Once you have the Fieldset, you can create Forms from it. Create a Uniform_Form class in 'application/classes/uniform/form/':

    class Uniform_Form_Login extends Uniform_Form {

        public function __construct($bind=array())
        {
            //the form class requires you only to specify the fieldset you derive fields from and the selection of fields to use

            parent::__construct(
                'user',
                array('name', 'password'),
                $bind
            );
            
            //here you can change fields too!
            $this->field('name')
                      ->rule('not_empty');
                      
        }

    }

3.    Done, you can now render and use your form:

In your controller:

    public action_login()
    {
        $form = Uniform::factory('Login')->bind($_POST);
        
        if( $_POST AND $form->check() )
        {
            $data = $form->as_array();
            //now you can use your form data here.

        }
        
        //the form displayed shows by default already entered data, as well as validation errors
        //you can also just render a selection of fields or single fields
        //all the rendering is done via Uniform view files, so you can easily change it's appearance
        $this->request->response = '<html><body>' .
            $form .
            '</body>';
    }
  
  






















