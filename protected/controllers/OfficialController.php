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
        $regionID = isset( $_GET[ 'RegionID' ] ) ? $_GET[ 'RegionID' ] : null;
        $cityID = isset( $_GET[ 'CityID' ] ) ? $_GET[ 'CityID' ] : null;
        
        $filter = array(
            'CityID' => $cityID,
            'RegionID' => $regionID,
            'DistrictID' => isset( $_GET[ 'DistrictID' ] ) ? $_GET[ 'DistrictID' ] : null
        );
        $officials = Official::model()->getList( $filter );
        
        $regions = Region::model()->findAll();
        $cities = City::model()->getList( $regionID );
        $districts = City::model()->getList( $cityID );
        
        $this->render( 
            'list',
            array(
                'officials' => $officials,
                'cities' => $cities,
                'distincts' => $districts,
                'regions' => $regions
            )
        );
    }
}
?>
