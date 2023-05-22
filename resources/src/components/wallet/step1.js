import React from 'react';
import IconGhostImage from "../../assets/img/icon-ghost.svg";
import IconDislikeImage from "../../assets/img/icon-dislike.svg";

const Step1 = () => {
    return (
        <div className="steps-content step1">
            <div className="container">
                <div className="title">Есть опыт и знания в крипте?</div>
                <div className="desc"><p>Сумма ряда позиционирует линейно зависимый тройной интеграл, явно демонстрируя всю чушь вышесказанного. Критерий сходимости Коши стабилизирует абстрактный лист Мёбиуса</p></div>
                <div className="borerbox">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="border-up">
                            <div className="innerbox bluebg">
                                <div className="box-img"><img src={IconGhostImage} /></div>
                                <div className="box-title">Да детка!</div>
                                <div className="box-content">
                                    <ul>
                                        <li>Матожидание уравновешивает</li>
                                        <li>Подынтегральное выражение</li>
                                        <li>Очевидно проверяется</li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="innerbox transparentbg">
                                <div className="box-img"><img src={IconDislikeImage} /></div>
                                <div className="box-title">Нет</div>
                                <div className="box-content">
                                    <ul>
                                        <li>Очевидно проверяется</li>
                                        <li>Приступая к доказательству следует безапелляционно заявить</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Step1;