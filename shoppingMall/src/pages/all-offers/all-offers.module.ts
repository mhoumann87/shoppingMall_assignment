import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AllOffers } from './all-offers';

@NgModule({
  declarations: [
    AllOffers,
  ],
  imports: [
    IonicPageModule.forChild(AllOffers),
  ],
  exports: [
    AllOffers
  ]
})
export class AllOffersModule {}
