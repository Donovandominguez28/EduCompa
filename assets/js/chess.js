let boardSquaresArray = [];
let isWhiteTurn = true;
let whiteKingSquare = "e1";
let blackKingSquare = "e8";
const boardSquares = document.getElementsByClassName("square");
const pieces = document.getElementsByClassName("piece");
const piecesImages = document.getElementsByTagName("img");

function fillBoardSquaresArray() {
  for (let i = 0; i < boardSquares.length; i++) {
    let row = 8 - Math.floor(i / 8);
    let column = String.fromCharCode(97 + (i % 8));
    let square = boardSquares[i];
    square.id = column + row;
    let color = "";
    let pieceType = "";
    let pieceId = "";
    if (square.querySelector(".piece")) {
      color = square.querySelector(".piece").getAttribute("color");
      pieceType = square.querySelector(".piece").classList[1];
      pieceId = square.querySelector(".piece").id;
    } else {
      color = "blank";
      pieceType = "blank";
      pieceId = "blank";
    }
    let arrayElement = {
      squareId: square.id,
      pieceColor: color,
      pieceType: pieceType,
      pieceId: pieceId,
    };
    boardSquaresArray.push(arrayElement);
  }
}

function updateBoardSquaresArray(currentSquareId, destinationSquareId) {
  let currentSquare = boardSquaresArray.find(
    (element) => element.squareId === currentSquareId
  );
  let destinationSquareElement = boardSquaresArray.find(
    (element) => element.squareId === destinationSquareId
  );
  destinationSquareElement.pieceColor = currentSquare.pieceColor;
  destinationSquareElement.pieceType = currentSquare.pieceType;
  destinationSquareElement.pieceId = currentSquare.pieceId;
  currentSquare.pieceColor = "blank";
  currentSquare.pieceType = "blank";
  currentSquare.pieceId = "blank";
}

function deepCopyArray(array) {
  return array.map((element) => {
    return { ...element };
  });
}

setupBoardSquares();
setupPieces();
fillBoardSquaresArray();

function setupBoardSquares() {
  for (let i = 0; i < boardSquares.length; i++) {
    boardSquares[i].addEventListener("dragover", allowDrop);
    boardSquares[i].addEventListener("drop", drop);
    let row = 8 - Math.floor(i / 8);
    let column = String.fromCharCode(97 + (i % 8));
    let square = boardSquares[i];
    square.id = column + row;
  }
}

function setupPieces() {
  for (let i = 0; i < pieces.length; i++) {
    pieces[i].addEventListener("dragstart", drag);
    pieces[i].setAttribute("draggable", true);
    pieces[i].id = pieces[i].className.split(" ")[1] + pieces[i].parentElement.id;
  }
  for (let i = 0; i < piecesImages.length; i++) {
    piecesImages[i].setAttribute("draggable", false);
  }
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  const piece = ev.target;
  const pieceColor = piece.getAttribute("color");
  const pieceType = piece.classList[1];
  const pieceId = piece.id;

  if ((isWhiteTurn && pieceColor === "white") || (!isWhiteTurn && pieceColor === "black")) {
    const startingSquareId = piece.parentNode.id;
    ev.dataTransfer.setData("text", pieceId + "|" + startingSquareId);
    const pieceObject = { pieceColor: pieceColor, pieceType: pieceType, pieceId: pieceId };
    let legalSquares = getPossibleMoves(startingSquareId, pieceObject, boardSquaresArray);

    let legalSquaresJson = JSON.stringify(legalSquares);
    ev.dataTransfer.setData("application/json", legalSquaresJson);
  }
}

function drop(ev) {
  ev.preventDefault();
  let data = ev.dataTransfer.getData("text");
  let [pieceId, startingSquareId] = data.split("|");
  let legalSquaresJson = ev.dataTransfer.getData("application/json");
  let legalSquares = JSON.parse(legalSquaresJson);

  const piece = document.getElementById(pieceId);
  const pieceColor = piece.getAttribute("color");
  const pieceType = piece.classList[1];

  const destinationSquare = ev.currentTarget;
  let destinationSquareId = destinationSquare.id;

  legalSquares = isMoveValidAgainstCheck(legalSquares, startingSquareId, pieceColor, pieceType);

  if (pieceType === "king") {
    let isCheck = isKingInCheck(destinationSquareId, pieceColor, boardSquaresArray);
    if (isCheck) return;
    isWhiteTurn ? (whiteKingSquare = destinationSquareId) : (blackKingSquare = destinationSquareId);
  }

  let squareContent = getPieceAtSquare(destinationSquareId, boardSquaresArray);
  if (squareContent.pieceColor === "blank" && legalSquares.includes(destinationSquareId)) {
    destinationSquare.appendChild(piece);
    isWhiteTurn = !isWhiteTurn;
    updateBoardSquaresArray(startingSquareId, destinationSquareId);
    checkForCheckMate();
    return;
  }
  if (squareContent.pieceColor !== "blank" && legalSquares.includes(destinationSquareId)) {
    let children = destinationSquare.children;
    for (let i = 0; i < children.length; i++) {
      if (!children[i].classList.contains("coordinate")) {
        destinationSquare.removeChild(children[i]);
      }
    }
    destinationSquare.appendChild(piece);
    isWhiteTurn = !isWhiteTurn;
    updateBoardSquaresArray(startingSquareId, destinationSquareId);
    checkForCheckMate();
    return;
  }
}

function getPossibleMoves(startingSquareId, piece, boardSquaresArray) {
  const pieceColor = piece.pieceColor;
  const pieceType = piece.pieceType;

  let legalSquares = [];
  if (pieceType === "pawn") {
    legalSquares = getPawnMoves(startingSquareId, pieceColor, boardSquaresArray);
    return legalSquares;
  }
  if (pieceType === "knight") {
    legalSquares = getKnightMoves(startingSquareId, pieceColor, boardSquaresArray);
    return legalSquares;
  }
  if (pieceType === "rook") {
    legalSquares = getRookMoves(startingSquareId, pieceColor, boardSquaresArray);
    return legalSquares;
  }
  if (pieceType === "bishop") {
    legalSquares = getBishopMoves(startingSquareId, pieceColor, boardSquaresArray);
    return legalSquares;
  }
  if (pieceType === "queen") {
    legalSquares = getQueenMoves(startingSquareId, pieceColor, boardSquaresArray);
    return legalSquares;
  }
  if (pieceType === "king") {
    legalSquares = getKingMoves(startingSquareId, pieceColor, boardSquaresArray);
    return legalSquares;
  }
}

function getPawnMoves(startingSquareId, pieceColor, boardSquaresArray) {
  let diagonalSquares = checkPawnDiagonalCaptures(startingSquareId, pieceColor, boardSquaresArray);
  let forwardSquares = checkPawnForwardMoves(startingSquareId, pieceColor, boardSquaresArray);
  let legalSquares = [...diagonalSquares, ...forwardSquares];
  return legalSquares;
}

function checkPawnDiagonalCaptures(startingSquareId, pieceColor, boardSquaresArray) {
  const file = startingSquareId.charAt(0);
  const rank = startingSquareId.charAt(1);
  const rankNumber = parseInt(rank);
  let legalSquares = [];
  let currentFile = file;
  let currentRank = rankNumber;
  let currentSquareId = currentFile + currentRank;

  const direction = pieceColor === "white" ? 1 : -1;
  if (!(rank === 8 && direction === 1) && !(rank === 1 && direction === -1))
    currentRank += direction;
  for (let i = -1; i <= 1; i += 2) {
    currentFile = String.fromCharCode(file.charCodeAt(0) + i);
    if (currentFile >= "a" && currentFile <= "h" && currentRank <= 8 && currentRank >= 1) {
      currentSquareId = currentFile + currentRank;
      let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
      let squareContent = currentSquare.pieceColor;
      if (squareContent !== "blank" && squareContent !== pieceColor)
        legalSquares.push(currentSquareId);
    }
  }
  return legalSquares;
}

function checkPawnForwardMoves(startingSquareId, pieceColor, boardSquaresArray) {
  const file = startingSquareId.charAt(0);
  const rank = startingSquareId.charAt(1);
  const rankNumber = parseInt(rank);
  let legalSquares = [];

  let currentFile = file;
  let currentRank = rankNumber;
  let currentSquareId = currentFile + currentRank;

  const direction = pieceColor === "white" ? 1 : -1;
  currentRank += direction;
  currentSquareId = currentFile + currentRank;
  let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
  let squareContent = currentSquare.pieceColor;
  if (squareContent !== "blank") return legalSquares;
  legalSquares.push(currentSquareId);

  if ((rank === "2" && pieceColor === "white") || (rank === "7" && pieceColor === "black")) {
    currentRank += direction;
    currentSquareId = currentFile + currentRank;
    let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
    let squareContent = currentSquare.pieceColor;
    if (squareContent === "blank") legalSquares.push(currentSquareId);
  }

  return legalSquares;
}

function getKnightMoves(startingSquareId, pieceColor, boardSquaresArray) {
  const file = startingSquareId.charAt(0);
  const rank = startingSquareId.charAt(1);
  const rankNumber = parseInt(rank);
  let legalSquares = [];
  let currentFile = file;
  let currentRank = rankNumber;
  let currentSquareId = currentFile + currentRank;

  let displacements = [
    [2, 1],
    [2, -1],
    [1, 2],
    [1, -2],
    [-2, 1],
    [-2, -1],
    [-1, 2],
    [-1, -2],
  ];

  for (let displacement of displacements) {
    currentFile = String.fromCharCode(file.charCodeAt(0) + displacement[0]);
    currentRank = rankNumber + displacement[1];
    if (currentFile >= "a" && currentFile <= "h" && currentRank <= 8 && currentRank >= 1) {
      currentSquareId = currentFile + currentRank;
      let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
      let squareContent = currentSquare.pieceColor;
      if (squareContent !== pieceColor) legalSquares.push(currentSquareId);
    }
  }
  return legalSquares;
}

function getRookMoves(startingSquareId, pieceColor, boardSquaresArray) {
  const file = startingSquareId.charAt(0);
  const rank = startingSquareId.charAt(1);
  const rankNumber = parseInt(rank);
  let legalSquares = [];
  let currentFile = file;
  let currentRank = rankNumber;
  let currentSquareId = currentFile + currentRank;

  const directions = [
    { file: 1, rank: 0 },
    { file: -1, rank: 0 },
    { file: 0, rank: 1 },
    { file: 0, rank: -1 },
  ];

  for (let direction of directions) {
    currentFile = file;
    currentRank = rankNumber;
    currentSquareId = currentFile + currentRank;
    while (true) {
      currentFile = String.fromCharCode(currentFile.charCodeAt(0) + direction.file);
      currentRank += direction.rank;
      if (currentFile >= "a" && currentFile <= "h" && currentRank <= 8 && currentRank >= 1) {
        currentSquareId = currentFile + currentRank;
        let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
        let squareContent = currentSquare.pieceColor;
        if (squareContent === pieceColor) break;
        legalSquares.push(currentSquareId);
        if (squareContent !== "blank") break;
      } else {
        break;
      }
    }
  }

  return legalSquares;
}

function getBishopMoves(startingSquareId, pieceColor, boardSquaresArray) {
  const file = startingSquareId.charAt(0);
  const rank = startingSquareId.charAt(1);
  const rankNumber = parseInt(rank);
  let legalSquares = [];
  let currentFile = file;
  let currentRank = rankNumber;
  let currentSquareId = currentFile + currentRank;

  const directions = [
    { file: 1, rank: 1 },
    { file: -1, rank: 1 },
    { file: 1, rank: -1 },
    { file: -1, rank: -1 },
  ];

  for (let direction of directions) {
    currentFile = file;
    currentRank = rankNumber;
    currentSquareId = currentFile + currentRank;
    while (true) {
      currentFile = String.fromCharCode(currentFile.charCodeAt(0) + direction.file);
      currentRank += direction.rank;
      if (currentFile >= "a" && currentFile <= "h" && currentRank <= 8 && currentRank >= 1) {
        currentSquareId = currentFile + currentRank;
        let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
        let squareContent = currentSquare.pieceColor;
        if (squareContent === pieceColor) break;
        legalSquares.push(currentSquareId);
        if (squareContent !== "blank") break;
      } else {
        break;
      }
    }
  }

  return legalSquares;
}

function getQueenMoves(startingSquareId, pieceColor, boardSquaresArray) {
  const rookMoves = getRookMoves(startingSquareId, pieceColor, boardSquaresArray);
  const bishopMoves = getBishopMoves(startingSquareId, pieceColor, boardSquaresArray);
  return [...rookMoves, ...bishopMoves];
}

function getKingMoves(startingSquareId, pieceColor, boardSquaresArray) {
  const file = startingSquareId.charAt(0);
  const rank = startingSquareId.charAt(1);
  const rankNumber = parseInt(rank);
  let legalSquares = [];
  let currentFile = file;
  let currentRank = rankNumber;
  let currentSquareId = currentFile + currentRank;

  const displacements = [
    { file: 1, rank: 1 },
    { file: -1, rank: 1 },
    { file: 1, rank: -1 },
    { file: -1, rank: -1 },
    { file: 0, rank: 1 },
    { file: 0, rank: -1 },
    { file: 1, rank: 0 },
    { file: -1, rank: 0 },
  ];

  for (let displacement of displacements) {
    currentFile = String.fromCharCode(file.charCodeAt(0) + displacement.file);
    currentRank = rankNumber + displacement.rank;
    if (currentFile >= "a" && currentFile <= "h" && currentRank <= 8 && currentRank >= 1) {
      currentSquareId = currentFile + currentRank;
      let currentSquare = boardSquaresArray.find((element) => element.squareId === currentSquareId);
      let squareContent = currentSquare.pieceColor;
      if (squareContent !== pieceColor) legalSquares.push(currentSquareId);
    }
  }
  return legalSquares;
}

function getPieceAtSquare(squareId, boardSquaresArray) {
  let square = boardSquaresArray.find((element) => element.squareId === squareId);
  let squareContent = {
    pieceColor: square.pieceColor,
    pieceType: square.pieceType,
    pieceId: square.pieceId,
  };
  return squareContent;
}

function isMoveValidAgainstCheck(legalSquares, startingSquareId, pieceColor, pieceType) {
  let legalSquaresAgainstCheck = [];
  let boardSquaresArrayCopy = deepCopyArray(boardSquaresArray);
  let currentSquare = boardSquaresArrayCopy.find((element) => element.squareId === startingSquareId);
  let opponentColor = pieceColor === "white" ? "black" : "white";
  for (let i = 0; i < legalSquares.length; i++) {
    updateBoardSquaresArray(startingSquareId, legalSquares[i], boardSquaresArrayCopy);
    let kingSquare = pieceColor === "white" ? whiteKingSquare : blackKingSquare;
    let inCheck = isKingInCheck(kingSquare, pieceColor, boardSquaresArrayCopy);
    if (!inCheck) legalSquaresAgainstCheck.push(legalSquares[i]);
  }
  return legalSquaresAgainstCheck;
}

function isKingInCheck(kingSquare, kingColor, boardSquaresArray) {
  let opponentColor = kingColor === "white" ? "black" : "white";
  for (let i = 0; i < boardSquaresArray.length; i++) {
    let square = boardSquaresArray[i];
    if (square.pieceColor === opponentColor) {
      let piece = { pieceColor: square.pieceColor, pieceType: square.pieceType };
      let legalMoves = getPossibleMoves(square.squareId, piece, boardSquaresArray);
      if (legalMoves.includes(kingSquare)) return true;
    }
  }
  return false;
}

function checkForCheckMate() {
  let kingColor = isWhiteTurn ? "white" : "black";
  let kingSquare = kingColor === "white" ? whiteKingSquare : blackKingSquare;
  if (isKingInCheck(kingSquare, kingColor, boardSquaresArray)) {
    let legalMoves = getPossibleMoves(kingSquare, { pieceColor: kingColor, pieceType: "king" }, boardSquaresArray);
    if (legalMoves.length === 0) alert(kingColor + " is in checkmate!");
  }
}
