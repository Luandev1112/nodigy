import React from 'react';

function Progress ({progress, isVisible}) {
    const { percantage, progressColor } = progress;
    const progressQuery = () => {
        return (
            <div className="progress-bar data-background"
                style={
                isVisible
                    ? {
                        width: `${percantage}%`,
                        background: progressColor,
                    }
                    : { width: 0, background: progressColor }
                }
            ></div>
        );
    };
    return (
        <div className="progress-item">
            <div className="progress-info">
                <span className="progress-number" style={{color: progressColor}}>{percantage}%</span>
            </div>
            <div className="progress">{progressQuery()}</div>
        </div>
    );
}
export default Progress;
