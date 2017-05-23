import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SingleOffer } from './single-offer';

@NgModule({
  declarations: [
    SingleOffer,
  ],
  imports: [
    IonicPageModule.forChild(SingleOffer),
  ],
  exports: [
    SingleOffer
  ]
})
export class SingleOfferModule {}
