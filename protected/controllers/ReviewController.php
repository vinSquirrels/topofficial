<?php
class ReviewController extends Controller {
    public function actionAddReview() {
        if( isset( $_POST[ 'Review' ] ) ) {
            $newReview = new Review();
            $newReview->attributes = $_POST[ 'Review' ];
            if( $newReview->save( true ) ) {
                
            }
            else {
                
            }
        }
        
        $this->redirect( Yii::app()->createUrl( 'official/view', array( 'id' => $_POST[ 'OfficialID' ] ) ) );
    }
    
    
}

?>
