<?php
class ReviewController extends Controller {
    public function actionAddReview() {
        if( isset( $_POST[ 'Review' ] ) ) {
            $newReview = new Review();
            $newReview->attributes = $_POST[ 'Review' ];
            if( $newReview->save( true ) ) {
                $newReview->addEstimates( $_POST[ 'Estimates' ] );
                // TODO
            }
            else {
                // TODO
            }
        }
        
        $this->redirect( Yii::app()->createUrl( 'official/view', array( 'id' => $_POST[ 'OfficialID' ] ) ) );
    }
    
    
}

?>
