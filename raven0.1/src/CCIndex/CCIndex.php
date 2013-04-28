 <?php
// Standard controller layout.

class CCIndex implements IController {

//Implementing interface IController. All controllers must have an index action.

  public function Index() {  
    global $ra;
    $ra->data['title'] = "The Index Controller";
  }

}  