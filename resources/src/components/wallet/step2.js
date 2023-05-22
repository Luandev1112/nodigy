import React, {useState, useEffect} from 'react';
import NYMImage from "../../assets/img/nym.png";
import EvmosImage from "../../assets/img/evmos-logo.png";
import StarknetImage from "../../assets/img/web3item4.png";
import ArbitrumImage from "../../assets/img/nodes-logo-icon2.png";

const Step2 = () => {
    return (
        <div className="steps-content step2">
            <div className="container">
                <div className="title">Доступ к продуктам</div>
                <div className="desc"><p>Многочлен стабилизирует невероятный критерий сходимости Коши. Несмотря на сложности, абсолютная погрешность последовательно транслирует аксиоматичный расходящийся ряд. Используя таблицу интегралов элементарных функций</p></div>
                <div className="borerbox">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="items item1 border-up">
                                <div className="innerbox transparentbg">
                                    <div className="box-img"><img src={NYMImage} /></div>
                                    <div className="box-content">
                                        <div className="box-title">NYM</div>
                                        <p>Продвижение проекта спорадически стабилизирует креативный анализ</p>
                                        <div className="setupfree">
                                            <a href="#">Setup fee</a>
                                            <div className="price">€20</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="items item2 border-down border-left">
                                <div className="innerbox transparentbg">
                                    <div className="box-img"><img src={EvmosImage} /></div>
                                    <div className="box-content">
                                        <div className="box-title">Evmos</div>
                                        <p>Сегмент рынка спонтанно специфицирует эмпирический потребительский</p>
                                        <div className="setupfree">
                                            <a href="#">Setup fee</a>
                                            <div className="price">€20</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="items item3 noborder">
                                <div className="innerbox transparentbg">
                                    <div className="box-img"><img src={StarknetImage} /></div>
                                    <div className="box-content">
                                        <div className="box-title">Starknet</div>
                                        <p>Традиционный канал многопланово искажает связанный формирование</p>
                                        <div className="setupfree">
                                            <a href="#">Setup fee</a>
                                            <div className="price">€20</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="items item4 border-right">
                                <div className="innerbox transparentbg">
                                    <div className="box-img"><img src={ArbitrumImage} /></div>
                                    <div className="box-content">
                                        <div className="box-title">Fusotao </div>
                                        <p>Продвижение проекта спорадически стабилизирует креативный анализ</p>
                                        <div className="setupfree">
                                            <a href="#">Setup fee</a>
                                            <div className="price">€20</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Step2;