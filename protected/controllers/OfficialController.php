<?php
class OfficialController extends Controller {
    public function actionView() {
        $id = isset( $_GET[ 'id' ] ) ? (integer) $_GET[ 'id' ] : null;
        $official = Official::model()->findByPk( $id );
        $criteriaEstimates = $official->getCriteriaEstimates();
        $rankValue = $official->getRank();
        $newReview = new Review();

        $this->render(
            'view', 
            array(
                'official' => $official,
                'reviews' => $official->reviews,
                'criteriaEstimates' => $criteriaEstimates,
                'rankValue' => $rankValue,
                'newReview' => $newReview
            )
        );
    }
    
    
    public function actionList() {
        $filter = array();
        $officials = Official::model()->getList( $filter );
        
        $this->render( 
            'list',
            array(
                'officials' => $officials
            )
        );
    }
}
?>
